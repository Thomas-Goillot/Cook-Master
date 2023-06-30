package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class user extends AppCompatActivity {

    private TextView userIdTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user);

        userIdTextView = findViewById(R.id.id);

        // Récupérer l'ID de l'utilisateur passé en extra
        int userId = getIntent().getIntExtra("userId", 0);

        // Afficher l'ID de l'utilisateur dans le TextView
        userIdTextView.setText("ID utilisateur : " + userId);

        // Appeler la méthode pour récupérer les informations de l'utilisateur
        userinfo(userId);
    }

    private void userinfo(int userId) {
        String url = "https://api.cookmaster.ovh/users/" + userId;

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            // Extraire les informations de l'utilisateur de la réponse JSON
                            String name = response.getString("name");
                            String surname = response.getString("surname");
                            String address = response.getString("address");
                            String city = response.getString("city");
                            String country = response.getString("country");
                            String phone = response.getString("phone");
                            String zip_code = response.getString("zip_code");
                            String creation_date = response.getString("creation_date");



                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(user.this, "Erreur inattendue", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        error.printStackTrace();
                        Toast.makeText(user.this, "Erreur de réseau", Toast.LENGTH_SHORT).show();
                    }
                });

        requestQueue.add(request);
    }
}
