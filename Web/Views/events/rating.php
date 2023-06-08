<?php
    if ($comment['stars'] == 1) {
        echo '<i class="mdi mdi-chef-hat text-danger"></i>';
    }

    if ($comment['stars'] == 2) {
        echo '<i class="mdi mdi-chef-hat text-danger"></i>';
        echo '<i class="mdi mdi-chef-hat text-danger"></i>';
    }

    if ($comment['stars'] == 3) {
        echo '<i class="mdi mdi-chef-hat text-danger"></i>';
        echo '<i class="mdi mdi-chef-hat text-danger"></i>';
        echo '<i class="mdi mdi-chef-hat text-warning"></i>';
    }

    if ($comment['stars'] == 4) {
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
    }

    if ($comment['stars'] == 5) {
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
        echo '<i class="mdi mdi-chef-hat text-success"></i>';
    }
    ?>








