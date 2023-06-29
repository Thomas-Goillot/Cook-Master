package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class user extends AppCompatActivity {

    private static final String EMAIL = "votre_emai";
    private static final String MOT_DE_PASSE = "votre_mot_de_passe";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user);

        TextView textViewResult = findViewById(R.id.textViewResult);

        String url = "https://api.cookmaster.ovh/users";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        try {
                            if (response.length() > 0) {
                                // Parcourir les utilisateurs de la réponse
                                for (int i = 0; i < response.length(); i++) {
                                    JSONObject user = response.getJSONObject(i);
                                    String username = user.getString("username");
                                    String email = user.getString("email");
                                    String password = user.getString("password");

                                    // Comparer l'email et le mot de passe avec les valeurs prédéfinies
                                    if (email.equals(EMAIL) && password.equals(MOT_DE_PASSE)) {
                                        // Les identifiants sont valides
                                        textViewResult.setText("Bienvenue, " + username);
                                        return;
                                    }
                                }

                                // Aucun utilisateur correspondant n'a été trouvé
                                Toast.makeText(user.this, "Identifiants invalides", Toast.LENGTH_SHORT).show();
                            } else {
                                Toast.makeText(user.this, "Erreur", Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(user.this, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                });

        requestQueue.add(request);
    }
}
