package com.example.cookmaster;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.List;

public class EventsAdapter extends BaseAdapter {

    private List<EventItem> shopItems;

    private Context context;

    public EventsAdapter(List<EventItem> shopItems, Context context) {
        this.shopItems = shopItems;
        this.context = context;
    }

    @Override
    public int getCount() {
        return shopItems.size();
    }

    @Override
    public Object getItem(int position) {
        return shopItems.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            LayoutInflater inflater = LayoutInflater.from(context);

            convertView = inflater.inflate(R.layout.rowshop, null);
        }

        TextView tv_name = convertView.findViewById(R.id.name);

        TextView tv_price = convertView.findViewById(R.id.price);

        ImageView iv_image = convertView.findViewById(R.id.image);

        ShopItem current = (ShopItem) getItem(position);

        tv_name.setText(current.getName());

        tv_price.setText(current.getPrice() + "€");

        Picasso.get().load(current.getImage()).into(iv_image);

        return convertView;
    }

}
