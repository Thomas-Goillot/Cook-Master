package com.example.cookmaster;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import org.w3c.dom.Text;

import java.util.List;

public class CoursesAdapter extends BaseAdapter {

    private List<Courses> courses;
    private Context context;

    public CoursesAdapter(List<Courses> courses, Context context) {
        this.courses = courses;
        this.context = context;
    }

    @Override
    public int getCount() {
        return this.courses.size();
    }

    @Override
    public Object getItem(int position) {
        return this.courses.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            LayoutInflater inflater = LayoutInflater.from(this.context);
            convertView = inflater.inflate(R.layout.row, null);
        }

        TextView tv_date = convertView.findViewById(R.id.tv_date);
        TextView tv_type = convertView.findViewById(R.id.tv_type);
        TextView tv_address = convertView.findViewById(R.id.tv_address);
        TextView tv_city = convertView.findViewById(R.id.tv_city);
        TextView tv_zip = convertView.findViewById(R.id.tv_zip);
        TextView tv_country = convertView.findViewById(R.id.tv_country);
        TextView tv_commentary = convertView.findViewById(R.id.tv_commentary);
        TextView tv_price = convertView.findViewById(R.id.tv_price);
        TextView tv_statut = convertView.findViewById(R.id.tv_statut);

        Courses current = (Courses) getItem(position);

        tv_date.setText("Date et heure du cours: " +current.getDateOfCourses());
        tv_type.setText("Type : " +String.valueOf(current.getType()));

        if(current.getCommentary().equals("null")) {
            tv_commentary.setText("Aucune demande spéciale");
        }else{
            tv_commentary.setText("Demande spécial : " +current.getCommentary());
        }

        if (current.getType() == 0) {
            tv_type.setText("Type : Cours à domicile");
            tv_address.setText("Adresse : Cours en présentiel. ");
            tv_city.setText("Ville : Cours en présentiel.");
            tv_zip.setText("Code postal : Cours en présentiel.");
            tv_country.setText("Pays : Cours en présentiel.");

        } else if (current.getType() == 1) {
            tv_type.setText("Type : Cours à distance");
            tv_address.setText("Adresse : " + current.getAddress());
            tv_city.setText("Ville : " +current.getCity());
            tv_zip.setText("Code postal : " +current.getZipCode());
            tv_country.setText("Pays : " +current.getCountry());
        }

        if (current.getStatut() == 1) {
            tv_statut.setText("Statut : En cours de paiement...");
            tv_price.setText("Prix nécéssaire à payer pour le cour : " + String.valueOf(current.getTotalPrice()) + "€");
        } else if (current.getStatut() == 2) {
            tv_statut.setText("Statut : Payé");
            tv_price.setText("Prix payé pour le cour : " + String.valueOf(current.getTotalPrice()) + "€");
        }




        return convertView;
    }
}
