package com.example.cookmaster;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;
import com.google.android.gms.ads.initialization.InitializationStatus;
import com.google.android.gms.ads.initialization.OnInitializationCompleteListener;

import org.json.JSONArray;
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
    private ListView listView;
    private Button buttonModify;
    private Button shop;
    private Button events;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.user);

        // Récupérer l'ID de l'utilisateur passé en extra
        int userId = getIntent().getIntExtra("userId", 0);

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
        shop = findViewById(R.id.shop);
        events = findViewById(R.id.events);


        listView = findViewById(R.id.listView);

        getcourses(userId);

        getsub(userId);

        buttonModify = findViewById(R.id.buttonModify);

        buttonModify.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(user.this, edituser.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });

        shop.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(user.this, Shop.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });

        events.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(user.this, Events.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });


    }


    private void getsub (int userId){
        String url = "https://api.cookmaster.ovh/sub/" + userId;

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {

                            JSONObject data = response.getJSONObject("data");
                            String sub = data.getString("id_subscription");

                            if (sub.equals("1")) {
                                MobileAds.initialize(user.this, new OnInitializationCompleteListener() {
                                    @Override
                                    public void onInitializationComplete(InitializationStatus initializationStatus) {
                                    }
                                });
                                AdView mAdView = findViewById(R.id.adView);
                                AdRequest adRequest = new AdRequest.Builder().build();
                                mAdView.loadAd(adRequest);

                                textSubscription.setText("Abonnement : Free");
                            } else if (sub.equals("2")) {
                                textSubscription.setText("Abonnement : Starter");
                            } else if (sub.equals("3")) {
                                textSubscription.setText("Abonnement : Master");
                            } else if (sub.equals("-1")) {
                                textSubscription.setText("Abonnement : Sannane");
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(user.this, "Erreur lors de la récupération des données", Toast.LENGTH_SHORT).show();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(user.this, "Erreur lors de la récupération des données", Toast.LENGTH_SHORT).show();
            }
        });

        requestQueue.add(request);
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
                            String creation_date = data.getString("creation_date");

                            // Afficher les informations de l'utilisateur dans les TextView correspondants
                            textName.setText("Nom : " + name);
                            textSurname.setText("Prénom : " + surname);
                            textAddress.setText("Adresse : " + address);
                            textCity.setText("Ville : " + city);
                            textZip.setText("Code postal : " + zip_code);
                            textCountry.setText("Pays : " + country);
                            textPhone.setText("Téléphone : " + phone);
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


    private void getcourses(int userId) {
        String url = "https://api.cookmaster.ovh/course/" + userId;

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest  request = new JsonObjectRequest (Request.Method.GET, url, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray coursesArray = response.getJSONArray("data");

                            List<Courses> coursesList = new ArrayList<>();
                            for (int i = 0; i < coursesArray.length(); i++) {
                                JSONObject course = coursesArray.getJSONObject(i);

                                String specialRequest = course.getString("special_request");
                                String dateOfCourses = course.getString("date_of_courses");
                                String dateOfRequest = course.getString("date_of_request");
                                int statut = course.getInt("statut");
                                String link = course.getString("link");
                                int type = course.getInt("type");
                                String address = course.getString("address");
                                String city = course.getString("city");
                                String zipCode = course.getString("zip_code");
                                String country = course.getString("country");
                                int totalPrice = course.getInt("total_price");
                                String commentary = course.getString("commentary");

                                Courses currentCourse = new Courses(specialRequest, dateOfCourses, dateOfRequest, statut, link, type, address, city, zipCode, country, totalPrice, commentary);
                                coursesList.add(currentCourse);
                            }

                            CoursesAdapter adapter = new CoursesAdapter(coursesList, user.this);
                            listView.setAdapter(adapter);
                        }catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(user.this, e.getMessage(), Toast.LENGTH_SHORT).show();
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
