package itcss.cleanalert;

import android.annotation.TargetApi;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.app.TaskStackBuilder;
import android.content.Context;
import android.content.Intent;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Build;
import android.os.IBinder;
import android.support.v4.app.NotificationCompat;
import android.util.Log;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

/**
 * Created by ITCS's Developer on 2/2/2559.
 */
public class ServiceCore extends Service {
    private boolean thread_flag = true;
    private int mId = 0;
    private String TOKEN_TEMP = "";
    @Override
    public void  onCreate()
    {
        super.onCreate();
        new Thread(new Runnable() {
            public void run() {
                TOKEN_TEMP = hostURL.MEMBER_TOKEN;

                if (hostURL.MEMBER_TOKEN != "") {
                    try {
                        FileOutputStream fileout = null;
                        fileout = openFileOutput("token.txt", MODE_PRIVATE);
                        OutputStreamWriter outputWriter = new OutputStreamWriter(fileout);
                        String app_value_text = TOKEN_TEMP;
                        outputWriter.write(app_value_text);
                        outputWriter.close();
                    }
                    catch (FileNotFoundException e) {
                        e.printStackTrace();
                    }
                    catch (IOException e) {
                        e.printStackTrace();
                    }
                }
                else
                {
                    String token_text = "";
                    FileInputStream fileIn = null;
                    try {
                        fileIn = openFileInput("token.txt");
                        InputStreamReader InputRead = new InputStreamReader(fileIn);

                        char[] inputBuffer = new char[128];
                        int charRead;
                        while ((charRead = InputRead.read(inputBuffer)) > 0) {
                            String readString = String.copyValueOf(inputBuffer, 0, charRead);
                            token_text += readString;
                        }
                        InputRead.close();

                        TOKEN_TEMP = token_text;
                    }
                    catch (FileNotFoundException e)
                    {
                        e.printStackTrace();
                    }
                    catch (IOException e)
                    {
                        e.printStackTrace();
                    }
                }


                while (thread_flag)
                {
                    try {
                        Thread.sleep(1000);
                        if(deadlock) {
                            GetText();
                        }
                    }
                    catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                    catch (UnsupportedEncodingException e) {
                        e.printStackTrace();
                    }
                }
            }
        }).start();
    }

    private boolean deadlock = true;
    // Create GetText Metod
    @TargetApi(Build.VERSION_CODES.JELLY_BEAN)
    public  void  GetText()  throws UnsupportedEncodingException
    {
        deadlock = false;
        String data = URLEncoder.encode("TOKEN", "UTF-8")
                + "=" + URLEncoder.encode(TOKEN_TEMP, "UTF-8");
        String text = "";
        BufferedReader reader = null;

        try {
            URL url = new URL(hostURL.URL_HOST + "api/api_get_message.php");

            URLConnection conn = url.openConnection();
            conn.setDoOutput(true);
            OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
            wr.write( data );
            wr.flush();

            reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
            StringBuilder sb = new StringBuilder();
            String line = null;

            while((line = reader.readLine()) != null)
            {
                sb.append(line + "\n");
            }
            text = sb.toString();
        }
        catch(Exception ex) {
        }
        finally   {
            try  {
                reader.close();
            }
            catch(Exception ex) {

            }
        }

        // text [START][NOTIFY][TICKER]Clean Alert[TITLE]คุณได้เติมเงิน[TEXT]คุณได้เติมเงินผ่านบัตร 80 บาท[END]
        if(text.indexOf("[START]") != -1) {

            String NOTIFY_Ticker = "";
            String NOTIFY_Title = "";
            String NOTIFY_Text = "";

            if(text.indexOf("[NOTIFY]") != -1) {
                NOTIFY_Ticker = text.substring(text.indexOf("[TICKER]")+8,text.indexOf("[TITLE]"));
                NOTIFY_Title = text.substring(text.indexOf("[TITLE]")+7,text.indexOf("[TEXT]"));
                NOTIFY_Text = text.substring(text.indexOf("[TEXT]")+6,text.indexOf("[END]"));
            }

            Uri alarmSound = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
            long[] pattern = {500,500};

            NotificationCompat.Builder mBuilder =
                    new NotificationCompat.Builder(this)
                            .setSmallIcon(R.drawable.whale)
                            .setTicker(NOTIFY_Ticker)
                            .setContentTitle(NOTIFY_Title)
                            .setContentText(NOTIFY_Text)
                            .setSound(alarmSound).
                            setVibrate(pattern);

            Intent resultIntent = new Intent(this, MainActivity.class);

            TaskStackBuilder stackBuilder = TaskStackBuilder.create(this);
            stackBuilder.addParentStack(MainActivity.class);
            stackBuilder.addNextIntent(resultIntent);
            PendingIntent resultPendingIntent =
                    stackBuilder.getPendingIntent(
                            0,
                            PendingIntent.FLAG_UPDATE_CURRENT
                    );
            mBuilder.setContentIntent(resultPendingIntent);
            NotificationManager mNotificationManager =
                    (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);

            mNotificationManager.notify(mId, mBuilder.build());
            mId++;

        }
        deadlock = true;
    }



    @Override
    public int onStartCommand(Intent intent,int flags,int startId)
    {
        thread_flag = true;
        return START_STICKY;
    }
    @Override
    public void onDestroy()
    {
        thread_flag = false;
        super.onDestroy();
    }
    @Override
    public IBinder onBind(Intent intent)
    {
        return null;
    }



}
