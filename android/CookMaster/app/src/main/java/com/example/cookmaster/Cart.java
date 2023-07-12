package com.example.cookmaster;

import android.annotation.SuppressLint;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class Cart extends AppCompatActivity {

    private TextView platTextView;


    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_panier);

        platTextView = findViewById(R.id.shopListView);


        SharedPreferences sharedPreferences = getSharedPreferences("Cart", MODE_PRIVATE);

        String plats = "";

        for (String platName : sharedPreferences.getAll().keySet()) {
            String prix = sharedPreferences.getString(platName, "");
            plats += "Plat : " + platName + " " + prix + " €\n";
        }

        platTextView.setText(plats);

    }
}