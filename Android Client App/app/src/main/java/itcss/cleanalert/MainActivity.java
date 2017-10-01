package itcss.cleanalert;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.os.Environment;
import android.support.design.widget.AppBarLayout;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ProgressBar;
import android.widget.Toast;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

public class MainActivity extends AppCompatActivity {

    private static final String EXTRA_MESSAGE = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        final WebView _wv = (WebView) findViewById(R.id.webView);
        _wv.setWebViewClient(new WebViewClient());
        _wv.setWebChromeClient(new WebChromeClient());

        _wv.setWebViewClient(new WebViewClient() {
            @Override
            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
                Toast.makeText(MainActivity.this, "Cannot connect Internet", Toast.LENGTH_LONG).show();
            }

            @Override
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                view.loadUrl(url);
                return true;
            }

            public void onPageFinished(WebView view, String url) {
                //region GET_URL
                if (view.getUrl().indexOf("smart_pay&nfc") != -1) {
                    Context contex = MainActivity.this;

                } else if (view.getUrl().indexOf("smart_pay&barcode") != -1) {
                    Context contex = MainActivity.this;
                    Intent intent = new Intent(MainActivity.this, barcode_Activity.class);
                    intent.putExtra(EXTRA_MESSAGE, "Barcode Ready");
                    startActivity(intent);
                } else if (view.getUrl().indexOf("smart_pay&otp") != -1) {
                    String otp_code = view.getUrl();
                    int temp = otp_code.indexOf("otp=") + 4;
                    hostURL.OTP_CODE = otp_code.substring(temp, temp + 6);
                    temp = otp_code.indexOf("otp_exp=") + 8;
                    hostURL.OTP_EXP_TEXT = otp_code.substring(temp, temp + 19);

                    if (hostURL.OTP_PAGE) {
                        Intent intent = new Intent(MainActivity.this, OTP.class);
                        intent.putExtra(EXTRA_MESSAGE, "Barcode Ready");
                        startActivity(intent);
                    }
                }
                //endregion

                if (view.getUrl().indexOf("token=") != -1) {
                    String token_code = view.getUrl();
                    int temp = token_code.indexOf("token=") + 6;
                    hostURL.MEMBER_TOKEN = token_code.substring(temp, temp + 64);
                    startService();
                }

                if (view.getUrl().indexOf("?login") != -1) {
                    hostURL.MEMBER_TOKEN = "";
                    stopService();
                    try {
                        FileOutputStream fileout = null;
                        fileout = openFileOutput("token.txt", MODE_PRIVATE);
                        OutputStreamWriter outputWriter = new OutputStreamWriter(fileout);
                        String app_value_text = "";
                        outputWriter.write(app_value_text);
                        outputWriter.close();
                    } catch (FileNotFoundException e) {
                        e.printStackTrace();
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                }

            }
        });

        _wv.loadUrl(hostURL.URL_HOST);
        _wv.clearCache(true);
        _wv.clearHistory();
        _wv.getSettings().setJavaScriptEnabled(true);
        _wv.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);

        if (hostURL.MEMBER_TOKEN == "")
        {
            _wv.loadUrl(hostURL.URL_HOST + "api/api_token.php");
        }


    }

    public void startService()
    {
        Intent intent = new Intent(this,ServiceCore.class);
        startService(intent);
    }

    public void stopService()
    {
        Intent intent = new Intent(this,ServiceCore.class);
        stopService(intent);
    }
}