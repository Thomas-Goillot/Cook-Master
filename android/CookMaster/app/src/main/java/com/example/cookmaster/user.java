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
    private TextView textName;
    private TextView textSurname;
    private TextView textAddress;
    private TextView textCity;
    private TextView textZip;
    private TextView textCountry;
    private TextView textPhone;
    private TextView textSubscription;
    private TextView textCreateAccount;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user);

        // Récupérer l'ID de l'utilisateur passé en extra
        int userId = getIntent().getIntExtra("userId", 0);

        // Appel de la fonction pour récupérer les informations de l'utilisateur
        userinfo(userId);

        userIdTextView = findViewById(R.id.id);
        textName = findViewById(R.id.textName);
        textSurname = findViewById(R.id.textSurname);
        textAddress = findViewById(R.id.textAddress);
        textCity = findViewById(R.id.textCity);
        textZip = findViewById(R.id.textZip);
        textCountry = findViewById(R.id.textCountry);
        textPhone = findViewById(R.id.textPhone);
        textSubscription = findViewById(R.id.textSubscription);
        textCreateAccount = findViewById(R.id.textCreateAccount);


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
                            String name = response.optString("name");
                            String surname = response.optString("surname");
                            String address = response.optString("address");
                            String city = response.optString("city");
                            String zip_code = response.optString("zip_code");
                            String country = response.optString("country");
                            String phone = response.optString("phone");
                            String sub = response.optString("id_access");
                            String creation_date = response.optString("creation_date");



                            // Afficher les informations de l'utilisateur dans les TextView correspondants
                            textName.setText("Nom : " + name);
                            textSurname.setText("Prénom : " + surname);
                            textAddress.setText("Adresse : " + address);
                            textCity.setText("Ville : " + city);
                            textZip.setText("Code postal : " + zip_code);
                            textCountry.setText("Pays : " + country);
                            textPhone.setText("Téléphone : " + phone);
                            textSubscription.setText("Abonnement : " + sub);
                            textCreateAccount.setText("Date de création : " + creation_date);

                        } catch (Throwable  e) {
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
