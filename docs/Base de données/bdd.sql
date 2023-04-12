CREATE TABLE
    access(
        id_access INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_access),
        UNIQUE(name)
    );

CREATE TABLE
    rewards(
        id_rewards INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        description VARCHAR(255),
        amount DOUBLE NOT NULL,
        currency VARCHAR(1) NOT NULL,
        nb_new_subscribers INT NOT NULL,
        PRIMARY KEY(id_rewards)
    );

CREATE TABLE
    shipping_type(
        id_shipping_type INT AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        PRIMARY KEY(id_shipping_type)
    );

CREATE TABLE
    subscription_option(
        id_subscription_option INT AUTO_INCREMENT,
        name VARCHAR(150) NOT NULL,
        description VARCHAR(255),
        PRIMARY KEY(id_subscription_option)
    );

CREATE TABLE
    renewal_bonus(
        id_renewal_bonus INT AUTO_INCREMENT,
        amount DOUBLE NOT NULL,
        currency VARCHAR(1) NOT NULL,
        payment_periodicity INT NOT NULL,
        PRIMARY KEY(id_renewal_bonus)
    );

CREATE TABLE
    location(
        id_location INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        address VARCHAR(255) NOT NULL,
        is_open BOOLEAN NOT NULL default TRUE,
        available_to_rental BOOLEAN NOT NULL DEFAULT TRUE,
        price_day DOUBLE NOT NULL DEFAULT 0,
        price_half_day DOUBLE NOT NULL DEFAULT 0,
        PRIMARY KEY(id_location)
    );

CREATE TABLE
    opening_hours(
        id_opening_hours INT AUTO_INCREMENT,
        opening_day VARCHAR(9) NOT NULL,
        opening_hours TIME NOT NULL,
        closing_hours TIME NOT NULL,
        PRIMARY KEY(id_opening_hours)
    );

CREATE TABLE
    command_status(
        id_command_status INT AUTO_INCREMENT,
        name VARCHAR(50),
        PRIMARY KEY(id_command_status)
    );

CREATE TABLE
    providers(
        id_providers INT AUTO_INCREMENT,
        type VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_providers)
    );

CREATE TABLE
    relay_point(
        id_relay_point INT AUTO_INCREMENT,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(150) NOT NULL,
        zip_code INT NOT NULL,
        country VARCHAR(150) NOT NULL,
        PRIMARY KEY(id_relay_point)
    );

CREATE TABLE
    shipping_address(
        id_shipping_address INT AUTO_INCREMENT,
        city VARCHAR(150) NOT NULL,
        country VARCHAR(150) NOT NULL,
        zip_code INT NOT NULL,
        address VARCHAR(255) NOT NULL,
        PRIMARY KEY(id_shipping_address)
    );

CREATE TABLE
    users(
        id_users INT AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        name VARCHAR(100) NOT NULL,
        surname VARCHAR(100) NOT NULL,
        address VARCHAR(200),
        city VARCHAR(200),
        country VARCHAR(255),
        phone VARCHAR(25) NOT NULL,
        password VARCHAR(255) NOT NULL,
        zip_code VARCHAR(10),
        is_banned BOOLEAN NOT NULL DEFAULT FALSE,
        sponsor_counter INT,
        id_access INT NOT NULL,
        PRIMARY KEY(id_users),
        UNIQUE(email),
        FOREIGN KEY(id_access) REFERENCES access(id_access)
    );

CREATE TABLE
    user_ip(
        id_user_ip INT AUTO_INCREMENT,
        ip VARCHAR(50) NOT NULL,
        id_users INT NOT NULL,
        PRIMARY KEY(id_user_ip),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE
    subscription(
        id_subscription INT AUTO_INCREMENT,
        name VARCHAR(40) NOT NULL,
        is_active BOOLEAN NOT NULL,
        price_monthly DOUBLE NOT NULL,
        price_yearly DOUBLE NOT NULL,
        access_to_lessons INT,
        id_renewal_bonus INT,
        PRIMARY KEY(id_subscription),
        FOREIGN KEY(id_renewal_bonus) REFERENCES renewal_bonus(id_renewal_bonus)
    );

CREATE TABLE
    user_navigation(
        id_navigation INT AUTO_INCREMENT,
        activity VARCHAR(50) NOT NULL,
        date_of_activity DATETIME NOT NULL,
        id_users INT NOT NULL,
        PRIMARY KEY(id_navigation),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE
    USER_VISIT(
        id_connexion INT AUTO_INCREMENT,
        date_connection DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        id_users INT NOT NULL,
        PRIMARY KEY(id_connexion),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE
    event_template(
        id_event_template INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        description VARCHAR(50),
        price DOUBLE NOT NULL DEFAULT 0,
        id_users INT NOT NULL,
        PRIMARY KEY(id_event_template),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE EVENT(ID_EVENT 
	INT AUTO_INCREMENT,
	date_start DATETIME NOT NULL,
	date_end DATETIME NOT NULL,
	id_users INT NOT NULL,
	id_event_template INT NOT NULL,
	PRIMARY KEY(id_event),
	FOREIGN KEY(id_users) REFERENCES users(id_users),
	FOREIGN KEY(id_event_template) REFERENCES event_template(id_event_template)
	);
	CREATE TABLE
	    equipment(
	        id_equipment INT AUTO_INCREMENT,
	        name VARCHAR(100) NOT NULL,
	        description VARCHAR(50),
	        image VARCHAR(50),
	        allow_rental BOOLEAN NOT NULL DEFAULT TRUE,
	        allow_event BOOLEAN NOT NULL DEFAULT TRUE,
	        allow_purchase BOOLEAN NOT NULL DEFAULT TRUE,
	        stock INT NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_equipment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    shopping_cart(
	        id_shopping_cart INT AUTO_INCREMENT,
	        shipping_adress VARCHAR(255) NOT NULL,
	        id_relay_point INT NOT NULL,
	        id_shipping_address INT NOT NULL,
	        id_command_status INT NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_shopping_cart),
	        FOREIGN KEY(id_relay_point) REFERENCES relay_point(id_relay_point),
	        FOREIGN KEY(id_shipping_address) REFERENCES shipping_address(id_shipping_address),
	        FOREIGN KEY(id_command_status) REFERENCES command_status(id_command_status),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    TCHAT(
	        id_message INT AUTO_INCREMENT,
	        content VARCHAR(255) NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_message),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    comment(
	        id_comment INT AUTO_INCREMENT,
	        content VARCHAR(255) NOT NULL,
	        stars INT NOT NULL,
	        id_users INT NOT NULL,
	        id_event INT NOT NULL,
	        PRIMARY KEY(id_comment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES event(id_event)
	    );
	CREATE TABLE
	    deliver_to(
	        id_subscription INT,
	        id_shipping_type INT,
	        PRIMARY KEY(
	            id_subscription,
	            id_shipping_type
	        ),
	        FOREIGN KEY(id_subscription) REFERENCES subscription(id_subscription),
	        FOREIGN KEY(id_shipping_type) REFERENCES shipping_type(id_shipping_type)
	    );
	CREATE TABLE
	    sponsors(
	        id_subscription INT,
	        id_rewards INT,
	        PRIMARY KEY(id_subscription, id_rewards),
	        FOREIGN KEY(id_subscription) REFERENCES subscription(id_subscription),
	        FOREIGN KEY(id_rewards) REFERENCES rewards(id_rewards)
	    );
	CREATE TABLE
	    give_access_to(
	        id_subscription INT,
	        id_subscription_option INT,
	        PRIMARY KEY(
	            id_subscription,
	            id_subscription_option
	        ),
	        FOREIGN KEY(id_subscription) REFERENCES subscription(id_subscription),
	        FOREIGN KEY(id_subscription_option) REFERENCES subscription_option(id_subscription_option)
	    );
	CREATE TABLE
	    subscribe_to(
	        id_users INT,
	        id_subscription INT,
	        type_of_payement VARCHAR(50) NOT NULL,
	        date_of_buy DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_subscription),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_subscription) REFERENCES subscription(id_subscription)
	    );
	CREATE TABLE
	    opens_at(
	        id_location INT,
	        id_opening_hours INT,
	        PRIMARY KEY(id_location, id_opening_hours),
	        FOREIGN KEY(id_location) REFERENCES location(id_location),
	        FOREIGN KEY(id_opening_hours) REFERENCES opening_hours(id_opening_hours)
	    );
	CREATE TABLE
	    take_place(
	        id_event INT,
	        id_location INT,
	        PRIMARY KEY(id_event, id_location),
	        FOREIGN KEY(id_event) REFERENCES event(id_event),
	        FOREIGN KEY(id_location) REFERENCES location(id_location)
	    );
	CREATE TABLE
	    use_equipment(
	        id_event INT,
	        id_equipment INT,
	        PRIMARY KEY(id_event, id_equipment),
	        FOREIGN KEY(id_event) REFERENCES event(id_event),
	        FOREIGN KEY(id_equipment) REFERENCES equipment(id_equipment)
	    );
	CREATE TABLE
	    rent_location(
	        id_users INT,
	        id_location INT,
	        start_rental DATETIME NOT NULL,
	        date_reservation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	        end_rental DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_location),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_location) REFERENCES location(id_location)
	    );
	CREATE TABLE
	    rent_equipment(
	        id_users INT,
	        id_equipment INT,
	        start_rental DATETIME NOT NULL,
	        end_rental DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_equipment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_equipment) REFERENCES equipment(id_equipment)
	    );
	CREATE TABLE
	    join_event(
	        id_users INT,
	        id_event INT,
	        PRIMARY KEY(id_users, id_event),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES event(id_event)
	    );
	CREATE TABLE
	    provider_occurs(
	        id_users INT,
	        id_event INT,
	        salary DOUBLE NOT NULL,
	        PRIMARY KEY(id_users, id_event),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES event(id_event)
	    );
	CREATE TABLE
	    contains(
	        id_equipment INT,
	        id_shopping_cart INT,
	        quantity INT,
	        PRIMARY KEY(
	            id_equipment,
	            id_shopping_cart
	        ),
	        FOREIGN KEY(id_equipment) REFERENCES equipment(id_equipment),
	        FOREIGN KEY(id_shopping_cart) REFERENCES shopping_cart(id_shopping_cart)
	    );
	CREATE TABLE
	    SEND_MESSAGE(
	        id_users INT,
	        id_message INT,
	        publication_date DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_message),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_message) REFERENCES TCHAT(id_message)
	    );
	CREATE TABLE
	    is_providers(
	        id_users INT,
	        id_providers INT,
	        PRIMARY KEY(id_users, id_providers),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_providers) REFERENCES providers(id_providers)
	    );
	CREATE TABLE
	    is_open_at(
	        id_opening_hours INT,
	        id_relay_point INT,
	        PRIMARY KEY(
	            id_opening_hours,
	            id_relay_point
	        ),
	        FOREIGN KEY(id_opening_hours) REFERENCES opening_hours(id_opening_hours),
	        FOREIGN KEY(id_relay_point) REFERENCES relay_point(id_relay_point)
	    );
