package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    private Button inscription;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        this.inscription = findViewById(R.id.buttonInscription);

        this.inscription.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                    Intent inscription = new Intent(MainActivity.this, inscription.class);
                    startActivity(inscription);
                };
            });
        };

        }