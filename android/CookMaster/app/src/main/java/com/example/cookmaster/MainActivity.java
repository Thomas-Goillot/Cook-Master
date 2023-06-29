package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

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
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.cookmaster.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

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

                // Hasher le mot de passe entré par l'utilisateur
                String enteredPasswordHashed = hashSHA256(enteredPassword);

                performLogin(enteredEmail, enteredPasswordHashed);
            }
        });
    }

    private void performLogin(String enteredEmail, String enteredPasswordHashed) {
        String url = "https://api.cookmaster.ovh/users";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        try {
                            if (response.length() > 0) {
                                boolean isLoginSuccessful = false;

                                // Parcourir les utilisateurs de la réponse
                                for (int i = 0; i < response.length(); i++) {
                                    JSONObject user = response.getJSONObject(i);
                                    String userEmail = user.getString("email");
                                    String userPasswordHashed = user.getString("password");

                                    // Comparer l'email et le mot de passe avec les valeurs fournies par l'utilisateur
                                    if (userEmail.equals(enteredEmail) && userPasswordHashed.equals(enteredPasswordHashed)) {
                                        // Les identifiants sont valides
                                        isLoginSuccessful = true;
                                        break;
                                    }
                                }

                                if (isLoginSuccessful) {
                                    Toast.makeText(MainActivity.this, "Identifiants valides", Toast.LENGTH_SHORT).show();
                                } else {
                                    Toast.makeText(MainActivity.this, "Identifiants invalides", Toast.LENGTH_SHORT).show();
                                }
                            } else {
                                Toast.makeText(MainActivity.this, "Aucun utilisateur trouvé", Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e("Login Error", error.getMessage());
                    }
                });

        requestQueue.add(request);
    }


    private String hashSHA256(String input) {
        try {
            MessageDigest digest = MessageDigest.getInstance("SHA-256");
            byte[] hashBytes = digest.digest(input.getBytes(StandardCharsets.UTF_8));
            StringBuilder stringBuilder = new StringBuilder();

            for (byte b : hashBytes) {
                String hex = Integer.toHexString(0xff & b);
                if (hex.length() == 1) {
                    stringBuilder.append('0');
                }
                stringBuilder.append(hex);
            }

            return stringBuilder.toString();
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }

        return null;
    }
}
