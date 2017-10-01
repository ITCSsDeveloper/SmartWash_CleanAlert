/* Copyright 2011-2013 Google Inc.
 * Copyright 2013 mike wakerly <opensource@hoho.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 * USA.
 *
 * Project home page: https://github.com/mik3y/usb-serial-for-android
 */

package com.hoho.android.usbserial.examples;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.hardware.usb.UsbDeviceConnection;
import android.hardware.usb.UsbManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ScrollView;
import android.widget.TextView;
import android.widget.Toast;

import com.hoho.android.usbserial.driver.UsbSerialPort;
import com.hoho.android.usbserial.util.HexDump;
import com.hoho.android.usbserial.util.SerialInputOutputManager;

import junit.framework.Test;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import src.com.hoho.android.usbserial.examples.AppData;

/**
 * Monitors a single {@link UsbSerialPort} instance, showing all data
 * received.
 *
 * @author mike wakerly (opensource@hoho.com)
 */
public class SerialConsoleActivity extends Activity {

    //region ไม่สนใจ
    private final String TAG = SerialConsoleActivity.class.getSimpleName();
    /**
     * Driver instance, passed in statically via
     * {@link #show(Context, UsbSerialPort)}.
     *
     * <p/>
     * This is a devious hack; it'd be cleaner to re-create the driver using
     * arguments passed in with the {@link #startActivity(Intent)} intent. We
     * can get away with it because both activities will run in the same
     * process, and this is a simple demo.
     */
    private static UsbSerialPort sPort = null;
    private final ExecutorService mExecutor = Executors.newSingleThreadExecutor();
    private SerialInputOutputManager mSerialIoManager;
    private final SerialInputOutputManager.Listener mListener =
            new SerialInputOutputManager.Listener() {

        @Override
        public void onRunError(Exception e) {
            Log.d(TAG, "Runner stopped.");
        }

        @Override
        public void onNewData(final byte[] data) {
                SerialConsoleActivity.this.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        SerialConsoleActivity.this.updateReceivedData(data);
                    }
                });
        }
    };
    //endregion
    //region Fragment
    private FrameLayout F_SerialMonitor; // Layout Serial Monitor
    private FrameLayout F_RegisterDevice; // Layout Register Device
    private FrameLayout F_MainMenu;       // Layout MainMenu
    //endregion
    //region OnCreate
    private TextView mTitleTextView;
    private TextView mDumpTextView;
    private ScrollView mScrollView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.serial_console);

        mTitleTextView = (TextView) findViewById(R.id.demoTitle);
        mDumpTextView = (TextView) findViewById(R.id.consoleText);
        mScrollView = (ScrollView) findViewById(R.id.demoScroller);
        ShowStatusButton = (Button) findViewById(R.id.ShowStatusButton);

        F_SerialMonitor = (FrameLayout) findViewById(R.id.LayoutSerialMonitor);
        F_SerialMonitor.setVisibility(View.VISIBLE);

        F_RegisterDevice = (FrameLayout) findViewById(R.id.LayoutRegisterDevice);
        F_RegisterDevice.setVisibility(View.INVISIBLE);

        F_MainMenu = (FrameLayout) findViewById(R.id.LayoutMainMenu);
        F_MainMenu.setVisibility(View.INVISIBLE);
    }
    private void updateReceivedData(byte[] data) {
        if(data.length == 16) {
            Process(data);
        }
    }
    //endregion

    private boolean Token = true;
    private Button ShowStatusButton;
    private String deData = "";
    private void Process(byte[] data)
    {
        if(AppData.TOKEN == "") // จะเข้าเฉพาะ loop แรก
        {
            // ถ้า TOKEN เป็นค่าว่าง จะต้องเข้าไปเช็ค Token.txt ก่อนเสมอ ว่าเคยมีการลงทะเบียนแล้วหรือยัง
            if(ReadToken().toString() == "") { // ถ้า ReadToken แล้วยังเป็นค่าว่าง แสดงว่า ยังไม่ได้ Register Device
                if (_GetViewRegister) // มันจะเข้าไปทำครั้งแรก
                {
                    GetViewRegister(); // เส็ดไม่เส็ด ก็จะทำแค่ครั้งแรกเท่าั้น
                }
            }
            else // แต่ถ้า Read เจอ Token ให้ ให้ข้ามการ Register ไป
            {
                AppData.TOKEN = ReadToken(); // ให้ AppData เก็บ Token เข้าไป แล้ว Return ออกไป
            }
        }
        else
        {
            if(Token) { // ถ้า Token == true ให้ทำการดึงหน้าที่ต้องการ
                Token = false; // ล็อคกระบวนการนี้
                try
                {
                    F_RegisterDevice.setVisibility(View.INVISIBLE); // ปิดหน้า Register
                    F_MainMenu.setVisibility(View.VISIBLE); // ให้เปิดหน้า MainMenu ขึ้นมา
                }
                catch (Exception e) {}
            }
            else
            {
                try {
                    deData = HexDump.dumpHexString(data);  // strArray.length = 16
                    String strArray[] = deData.split(" ");
                    ShowStatusButton.setText(deData.toString());
                }
                catch (Exception e) {  }
            }
        }
    }



    private boolean WriteToken(String Token)
    {
        try {
            FileOutputStream fileout = null;
            fileout = openFileOutput("token.txt", MODE_PRIVATE);
            OutputStreamWriter outputWriter = new OutputStreamWriter(fileout);
            String TokenWrite = Token;
            outputWriter.write(TokenWrite);
            outputWriter.close();
            return true;
        }
        catch (FileNotFoundException e) {
            e.printStackTrace();
        }
        catch (IOException e) {
            e.printStackTrace();
        }
        return false;
    }
    private String ReadToken()
    {
        String TokenRead = "";
        FileInputStream fileIn = null;
        try {
            fileIn = openFileInput("token.txt");
            InputStreamReader InputRead = new InputStreamReader(fileIn);

            char[] inputBuffer = new char[128];
            int charRead;
            while ((charRead = InputRead.read(inputBuffer)) > 0) {
                String readString = String.copyValueOf(inputBuffer, 0, charRead);
                TokenRead += readString;
            }
            InputRead.close();
            return TokenRead;
        }
        catch (FileNotFoundException e){
            e.printStackTrace();
        }
        catch (IOException e){
            e.printStackTrace();
        }
        return "";
    }


    private LocationManager locationManager;
    private LocationListener locationListener;
    private EditText LocationText;
    private TextView FeedBackDeviceRegister;
    boolean _GetViewRegister = true;
    private void GetViewRegister()
    {
        //region ประกาศตัวแปร
        _GetViewRegister = false;
        F_SerialMonitor.setVisibility(View.INVISIBLE);
        F_RegisterDevice.setVisibility(View.VISIBLE);
        locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);
        LocationText = (EditText) findViewById(R.id.LocationText);
        final EditText TokenText = (EditText) findViewById(R.id.TokenText);
        final EditText WashingText = (EditText) findViewById(R.id.WashingText);
        FeedBackDeviceRegister = (TextView) findViewById(R.id.feedBackDeviceRegister);
        //endregion
        //region GPS
        locationListener = new LocationListener() {
            @Override
            public void onLocationChanged(Location location) {
                LocationText.setText(location.getLatitude() + "," + location.getLongitude());
            }
            @Override
            public void onStatusChanged(String provider, int status, Bundle extras) {

            }
            @Override
            public void onProviderEnabled(String provider) {

            }
            @Override
            public void onProviderDisabled(String provider) {
                Intent intent = new Intent(Settings.ACTION_LOCALE_SETTINGS);
            }
        };
        locationManager.requestLocationUpdates("gps", 1000, 0, locationListener);
        //endregion
        final Button SubmitButton = (Button) findViewById(R.id.SubmitButton);
        SubmitButton.setOnClickListener(new View.OnClickListener() {
            public void onClick(View view) {
                // Check ERROR is Null value
                if (TokenText.getText().toString().toString().isEmpty()) {
                    FeedBackDeviceRegister.setText("Token Not Null");
                } else if (WashingText.getText().toString().isEmpty()) {
                    FeedBackDeviceRegister.setText("WashingName Not Null");
                }
                else  {
                    new Thread(new Runnable() {
                        public void run() {
                            String text = "";
                            BufferedReader reader = null;
                            try {
                                String data = URLEncoder.encode("TokenText", "UTF-8")
                                        + "=" + URLEncoder.encode(TokenText.getText().toString(), "UTF-8")
                                        + "&" + URLEncoder.encode("WashingText", "UTF-8")
                                        + "=" + URLEncoder.encode(WashingText.getText().toString(), "UTF-8")
                                        + "&" + URLEncoder.encode("LocationText", "UTF-8")
                                        + "=" + URLEncoder.encode(LocationText.getText().toString(), "UTF-8")
                                        + "&" + URLEncoder.encode("Register", "UTF-8")
                                        + "=" + URLEncoder.encode("RpW1C0ToD5g6", "UTF-8");

                                URL url = new URL(AppData.URL_HOST + "api/api_wash_register.php");
                                URLConnection conn = url.openConnection();
                                conn.setDoOutput(true);
                                OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
                                wr.write(data);
                                wr.flush();

                                reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                                StringBuilder sb = new StringBuilder();
                                String line = null;

                                while ((line = reader.readLine()) != null) {
                                    sb.append(line + "\n");
                                }
                                text = sb.toString();

                                try {
                                    if (text.toString().indexOf("OK") != -1)
                                    {
                                        WriteToken(TokenText.getText().toString());
                                        AppData.TOKEN =  ReadToken();
                                    }
                                    else
                                    {
                                        FeedBackDeviceRegister.setText(text.toString());
                                    }
                                }
                                catch (Exception e) {
                                }

                            } catch (UnsupportedEncodingException e) {
                                e.printStackTrace();
                            } catch (MalformedURLException e) {
                                e.printStackTrace();
                            } catch (IOException e) {
                                e.printStackTrace();
                            }
                            finally   {
                                try  {
                                    reader.close();
                                }
                                catch(Exception ex) {

                                }
                            }
                        }
                    }).start();
                    }
                }
            }
            );
        }

    //region Hidden CODE
    @Override
    protected void onPause() {
        super.onPause();
        stopIoManager();
        if (sPort != null) {
            try {
                sPort.close();
            } catch (IOException e) {
                // Ignore.
            }
            sPort = null;
        }
        finish();
    }

        @Override
    protected void onResume() {
        super.onResume();
        Log.d(TAG, "Resumed, port=" + sPort);
        if (sPort == null) {
            mTitleTextView.setText("No serial device.");
        } else {
            final UsbManager usbManager = (UsbManager) getSystemService(Context.USB_SERVICE);

            UsbDeviceConnection connection = usbManager.openDevice(sPort.getDriver().getDevice());
            if (connection == null) {
                mTitleTextView.setText("Opening device failed");
                return;
            }

            try {
                sPort.open(connection);
                sPort.setParameters(250000, 8, UsbSerialPort.STOPBITS_1, UsbSerialPort.PARITY_NONE);
            } catch (IOException e) {
                Log.e(TAG, "Error setting up device: " + e.getMessage(), e);
                mTitleTextView.setText("Error opening device: " + e.getMessage());
                try {
                    sPort.close();
                } catch (IOException e2) {
                    // Ignore.
                }
                sPort = null;
                return;
            }
            mTitleTextView.setText("Serial device: " + sPort.getClass().getSimpleName());
        }
        onDeviceStateChange();
    }

    private void stopIoManager() {
        if (mSerialIoManager != null) {
            Log.i(TAG, "Stopping io manager ..");
            mSerialIoManager.stop();
            mSerialIoManager = null;
        }
    }

    private void startIoManager() {
        if (sPort != null) {
            Log.i(TAG, "Starting io manager ..");
            mSerialIoManager = new SerialInputOutputManager(sPort, mListener);
            mExecutor.submit(mSerialIoManager);
        }
    }

    private void onDeviceStateChange() {
        stopIoManager();
        startIoManager();
    }


    /**
     * Starts the activity, using the supplied driver instance.
     *
     * @param context
     * @param driver
     */
    static void show(Context context, UsbSerialPort port) {
        sPort = port;
        final Intent intent = new Intent(context, SerialConsoleActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP | Intent.FLAG_ACTIVITY_NO_HISTORY);
        context.startActivity(intent);
    }
    //endregion
}
