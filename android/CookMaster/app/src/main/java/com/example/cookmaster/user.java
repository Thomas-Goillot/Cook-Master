package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
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

import java.util.ArrayList;
import java.util.List;

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

    private ListView ll;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user);

        // Récupérer l'ID de l'utilisateur passé en extra
        int userId = getIntent().getIntExtra("userId", 0);

        // Appel de la fonction pour récupérer les informations de l'utilisateur
        userinfo(userId);

        textName = findViewById(R.id.textName);
        textSurname = findViewById(R.id.textSurname);
        textAddress = findViewById(R.id.textAddress);
        textCity = findViewById(R.id.textCity);
        textZip = findViewById(R.id.textZip);
        textCountry = findViewById(R.id.textCountry);
        textPhone = findViewById(R.id.textPhone);
        textSubscription = findViewById(R.id.textSubscription);
        textCreateAccount = findViewById(R.id.textCreateAccount);

        /*ll = findViewById(R.id.lv);
        CoursesAdapter eadap = new CoursesAdapter(getCourses(), user.this);
        ll.setAdapter(eadap);

        ll.setOnItemClickListener(new AdapterView.OnItemClickListener(){
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                //Afficher l'adresse dans un toast
                Toast.makeText(user.this, "Adresse : " + getCourses().get(i).getAddress(), Toast.LENGTH_SHORT).show();
            }
        });*/

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
                            JSONObject data = response.getJSONObject("data");
                            int userId = data.getInt("id_users");
                            String name = data.getString("name");
                            String surname = data.getString("surname");
                            String address = data.getString("address");
                            String city = data.getString("city");
                            String zip_code = data.getString("zip_code");
                            String country = data.getString("country");
                            String phone = data.getString("phone");
                            String sub = data.getString("id_access");
                            String creation_date = data.getString("creation_date");

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
                            Toast.makeText(user.this, e.getMessage(), Toast.LENGTH_SHORT).show();
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

    //Créer une liste de cours
    public List<Courses> getCourses(){
        List<Courses> resultat = new ArrayList<>();
        resultat.add(new Courses(1, "Cours pas très long", "10/07/23", "10/06/23", 3, "https://www.google.com/maps/search/?api=1&query=45.403588,4.387178", 0, 5, "15 rue de la croix l'évêque", "Trilport", "77470", "France", 112));
        return resultat;
    }
}
