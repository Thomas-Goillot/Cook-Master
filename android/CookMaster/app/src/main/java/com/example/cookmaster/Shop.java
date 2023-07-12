package com.example.cookmaster;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Shop extends AppCompatActivity {

    private ListView listViewShop;
    private Button panier;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shop);

        listViewShop = findViewById(R.id.listViewShop);
        panier = findViewById(R.id.panier);

        panier.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Shop.this, Cart.class);
                startActivity(intent);
            }
        });

        getShop();
    }

    private void getShop() {
        String url = "https://api.cookmaster.ovh/shop";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONObject shopObject = response.getJSONObject("data");

                            List<ShopItem> shopList = new ArrayList<>();

                            // Récupérer les informations du shopObject et créer un objet ShopItem
                            String name = shopObject.getString("name");
                            String price = shopObject.getString("price_purchase");
                            String image = shopObject.getString("image");
                            ShopItem currentShop = new ShopItem(name, price, image);

                            shopList.add(currentShop);

                            // Créer l'adaptateur et l'associer à la ListView
                            ShopAdapter adapter = new ShopAdapter(shopList, Shop.this);
                            listViewShop.setAdapter(adapter);
                        } catch (JSONException e) {
                            e.printStackTrace();
                            Log.e("JSON Error", e.toString());
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        error.printStackTrace();
                        Log.e("Network Error", error.toString());
                    }
                });

        requestQueue.add(request);
    }
}
