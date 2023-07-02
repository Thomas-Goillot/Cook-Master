package com.example.cookmaster;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

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
    public Object getItem(int i) {
        return this.courses.get(i);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(convertView == null){ //Si la vue n'existe pas
            LayoutInflater inflater = LayoutInflater.from(this.context);
            convertView = inflater.inflate(R.layout.row, null);
        }

        TextView tv_date = convertView.findViewById(R.id.tv_date);
        TextView tv_type = convertView.findViewById(R.id.tv_type);

        Courses current = (Courses) getItem(position);

        tv_date.setText(current.getDate());
        tv_type.setText(current.getType());

        return convertView;
    }
}
