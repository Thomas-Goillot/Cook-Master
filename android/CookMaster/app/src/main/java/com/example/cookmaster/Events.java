package com.example.cookmaster;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Events extends AppCompatActivity {
    private ListView listViewShop;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_events);

        listViewShop = findViewById(R.id.listViewShop);

        getShop();

        listViewShop.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                EventItem currentItem = (EventItem) parent.getItemAtPosition(position);
                String name = currentItem.getName();
                String price = currentItem.getPrice();
                String date = currentItem.getDate();

                String message = name + "sélectionné";

                new AlertDialog.Builder(Events.this)
                        .setTitle(message)
                        .setMessage("Prix : " + price + " euros \nDate : " + date)
                        .setPositiveButton("Acheter", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                SharedPreferences sharedPreferences = getSharedPreferences("Events", MODE_PRIVATE);
                                SharedPreferences.Editor editor = sharedPreferences.edit();

                                editor.putString("name", name);
                                editor.putString("price", price);
                                editor.putString("date", date);
                                editor.apply();

                                //METTRE LA REDIRECTION ICI
                            }
                        })
                        .setNegativeButton("Annuler", null)
                        .show();


            }
        });
    }

    private void getShop() {
        String url = "https://api.cookmaster.ovh/events";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONObject shopObject = response.getJSONObject("data");

                            List<ShopItem> shopList = new ArrayList<>();

                            String name = shopObject.getString("name");
                            String price = shopObject.getString("price_purchase");
                            String date = shopObject.getString("date");
                            ShopItem currentShop = new ShopItem(name, price, date);

                            shopList.add(currentShop);

                            ShopAdapter adapter = new ShopAdapter(shopList, Events.this);
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
