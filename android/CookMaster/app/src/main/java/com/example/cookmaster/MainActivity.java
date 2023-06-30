package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity {

    private EditText emailEditText, passwordEditText;
    private Button connectButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        emailEditText = findViewById(R.id.email);
        passwordEditText = findViewById(R.id.password);
        connectButton = findViewById(R.id.login);

        connectButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String enteredEmail = emailEditText.getText().toString();
                String enteredPassword = passwordEditText.getText().toString();

                performLogin(enteredEmail, enteredPassword);
            }
        });
    }

    private void performLogin(String enteredEmail, String enteredPassword) {
        String url = "https://api.cookmaster.ovh/login";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JSONObject requestData = new JSONObject();
        try {
            requestData.put("email", enteredEmail);
            requestData.put("password", enteredPassword);
        } catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(MainActivity.this, "Erreur lors de la création des données de la requête.", Toast.LENGTH_SHORT).show();
            return;
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, requestData,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            boolean success = response.getBoolean("success");

                            if (success) {
                                int userId = response.getInt("data");

                                // Enregistrer l'ID de l'utilisateur dans SharedPreferences
                                SharedPreferences sharedPreferences = getSharedPreferences("UserPrefs", Context.MODE_PRIVATE);
                                SharedPreferences.Editor editor = sharedPreferences.edit();
                                editor.putInt("userId", userId);
                                editor.apply();

                                // Lancer l'activité User avec l'ID de l'utilisateur en extra
                                Intent intent = new Intent(MainActivity.this, user.class);
                                intent.putExtra("userId", userId);
                                startActivity(intent);

                            } else {
                                JSONObject errorObject = response.getJSONObject("error");
                                String errorMessage = errorObject.getString("message");
                                Toast.makeText(MainActivity.this, "Identifiants invalides. Erreur : " + errorMessage, Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(MainActivity.this, "Erreur lors de l'analyse des données.", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        if (error != null && error.networkResponse != null && error.networkResponse.data != null) {
                            String errorMessage = new String(error.networkResponse.data);
                            Log.e("Login Error", errorMessage);
                            try {
                                JSONObject errorJson = new JSONObject(errorMessage);
                                JSONObject errorObject = errorJson.getJSONObject("error");
                                errorMessage = errorObject.getString("message");
                                Toast.makeText(MainActivity.this, errorMessage, Toast.LENGTH_SHORT).show();
                            } catch (JSONException e) {

                            }
                        } else {
                            Log.e("Login Error", "Une erreur est survenue");
                            Toast.makeText(MainActivity.this, "Une erreur est survenue", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

        requestQueue.add(request);
    }

}
