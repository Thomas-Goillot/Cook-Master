package com.example.cookmaster;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.List;

public class CartAdapter extends ArrayAdapter<String> {

    private List<String> cartItems;
    private Context context;

    public CartAdapter(List<String> cartItems, Context context) {
        super(context, R.layout.cart_item, cartItems);
        this.cartItems = cartItems;
        this.context = context;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View view = convertView;
        ViewHolder holder;

        if (view == null) {
            LayoutInflater inflater = LayoutInflater.from(context);
            view = inflater.inflate(R.layout.cart_item, null);
            holder = new ViewHolder();
            holder.platName = view.findViewById(R.id.platName);
            holder.platPrice = view.findViewById(R.id.platPrice);
            view.setTag(holder);
        } else {
            holder = (ViewHolder) view.getTag();
        }

        String cartItem = cartItems.get(position);
        String[] itemParts = cartItem.split(":");
        String platName = itemParts[0].trim();
        String platPrice = itemParts[1].trim();

        holder.platName.setText(platName);
        holder.platPrice.setText(platPrice + " €");

        return view;
    }

    static class ViewHolder {
        TextView platName;
        TextView platPrice;
    }
}

