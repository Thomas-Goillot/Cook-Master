package com.example.cookmaster;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class edituser extends AppCompatActivity {

    private EditText name, surname, email, phone;

    private Button buttonEdit;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.edituser);


        name = findViewById(R.id.editTextName);
        surname = findViewById(R.id.editTextSurname);
        email = findViewById(R.id.editTextMail);
        phone = findViewById(R.id.editTextPhone);

        buttonEdit = findViewById(R.id.buttonEdit);

        int userId = getIntent().getIntExtra("userId", 0);

        buttonEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                edituser(userId,name, surname, email, phone);
            }
        });



    }


    private void edituser(Integer userId, EditText name, EditText surname, EditText email, EditText phone) {
        String url = "https://api.cookmaster.ovh/users/";

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JSONObject requestData = new JSONObject();
        try {
            requestData.put("id", userId);
            requestData.put("name", name.getText().toString());
            requestData.put("surname", surname.getText().toString());
            requestData.put("email", email.getText().toString());
            requestData.put("phone", phone.getText().toString());
        } catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(edituser.this, "Erreur lors de la modification", Toast.LENGTH_SHORT).show();
            return;
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.PATCH, url, requestData,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            boolean success = response.getBoolean("success");

                            if (success) {
                                Intent intent = new Intent(edituser.this, MainActivity.class);
                                startActivity(intent);
                                Toast.makeText(edituser.this, "Utilisateur modifié avec succès", Toast.LENGTH_SHORT).show();

                            } else {
                                JSONObject errorObject = response.getJSONObject("error");
                                String errorMessage = errorObject.getString("message");
                                Toast.makeText(edituser.this, "Identifiants invalides. Erreur : " + errorMessage, Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(edituser.this, "Erreur lors de l'analyse des données.", Toast.LENGTH_SHORT).show();
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
                                Toast.makeText(edituser.this, errorMessage, Toast.LENGTH_SHORT).show();
                            } catch (JSONException e) {

                            }
                        } else {
                            Log.e("Login Error", "Une erreur est survenue");
                            Toast.makeText(edituser.this, "Une erreur est survenue", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

        requestQueue.add(request);
    }
}
