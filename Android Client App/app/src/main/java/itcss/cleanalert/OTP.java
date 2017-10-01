package itcss.cleanalert;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class OTP extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        hostURL.OTP_PAGE = false;
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_otp);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        EditText OTP_TEXTBOX = (EditText)findViewById(R.id.OTP_TEXTBOX);
        OTP_TEXTBOX.setEnabled(false);
        OTP_TEXTBOX.setGravity(Gravity.CENTER);

        TextView OTP_EXP_TEXT = (TextView) findViewById(R.id.OTP_EXP_TEXT);
        OTP_EXP_TEXT.setText("หมดอายุเวลา : " + hostURL.OTP_EXP_TEXT);

        OTP_TEXTBOX.setText(hostURL.OTP_CODE);
        hostURL.OTP_CODE = "NULL";
        hostURL.OTP_EXP_TEXT = "NULL";
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
