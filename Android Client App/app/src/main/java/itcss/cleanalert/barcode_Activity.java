package itcss.cleanalert;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class barcode_Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_barcode_);
        WebView _wv = (WebView) findViewById(R.id.webView);
        _wv.setWebViewClient(new WebViewClient());
        _wv.setWebChromeClient(new WebChromeClient());

        _wv.loadUrl(hostURL.URL_HOST + "api/api_barcode.php?code=JIjjsu77isjUsa");
        _wv.setWebViewClient(new WebViewClient() {
            public void onPageFinished(WebView view, String url) {
                Log.i("URL", view.getUrl());
            }
        });
        _wv.clearCache(true);
        _wv.clearHistory();
        _wv.getSettings().setJavaScriptEnabled(true);
        _wv.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);

    }

    @Override
    public void onBackPressed() {
        hostURL.OTP_CODE = "NULL";
        hostURL.OTP_EXP_TEXT = "NULL";
        hostURL.OTP_PAGE = true;
        finish();
        return;
    }

}
