package com.example.cookmaster;

import android.annotation.SuppressLint;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.ListView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.ArrayList;
import java.util.List;

public class Cart extends AppCompatActivity {

    private ListView listViewShop;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_panier);

        listViewShop = findViewById(R.id.shopListView);

        SharedPreferences sharedPreferences = getSharedPreferences("Cart", MODE_PRIVATE);

        List<String> cartItems = new ArrayList<>();

        for (String platName : sharedPreferences.getAll().keySet()) {
            String prix = sharedPreferences.getString(platName, "");
            String cartItem = "Plat : " + platName + " " + prix + " €";
            cartItems.add(cartItem);
        }

        CartAdapter adapter = new CartAdapter(cartItems, this);
        listViewShop.setAdapter(adapter);
    }
}
