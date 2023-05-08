CREATE TABLE
    ACCESS(
        id_access INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_access),
        UNIQUE(name)
    );

CREATE TABLE
    REWARDS(
        id_rewards INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        description VARCHAR(255),
        amount DOUBLE NOT NULL,
        curency VARCHAR(1) NOT NULL,
        nb_new_subscribers INT NOT NULL,
        PRIMARY KEY(id_rewards)
    );

CREATE TABLE
    SHIPPING_TYPE(
        id_shipping_type INT AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        PRIMARY KEY(id_shipping_type)
    );

CREATE TABLE
    SUBSCRIPTION_OPTION(
        id_subscription_option INT AUTO_INCREMENT,
        name VARCHAR(150) NOT NULL,
        description VARCHAR(255),
        PRIMARY KEY(id_subscription_option)
    );

CREATE TABLE
    RENEWAL_BONUS(
        id_renewal_bonus INT AUTO_INCREMENT,
        amount DOUBLE NOT NULL,
        currency VARCHAR(1) NOT NULL,
        payment_periodicity INT NOT NULL,
        PRIMARY KEY(id_renewal_bonus)
    );

CREATE TABLE
    OPENING_HOURS(
        id_opening_hours INT AUTO_INCREMENT,
        opening_day VARCHAR(9) NOT NULL,
        opening_hours TIME NOT NULL,
        closing_hours TIME NOT NULL,
        PRIMARY KEY(id_opening_hours)
    );

CREATE TABLE
    COMMAND_STATUS(
        id_command_status INT AUTO_INCREMENT,
        name VARCHAR(50),
        PRIMARY KEY(id_command_status)
    );

CREATE TABLE
    PROVIDERS_TYPE(
        id_providers_type INT AUTO_INCREMENT,
        type VARCHAR(50) NOT NULL,
        PRIMARY KEY(id_providers_type)
    );

CREATE TABLE
    RELAY_POINT(
        id_relay_point INT AUTO_INCREMENT,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(150) NOT NULL,
        zip_code INT NOT NULL,
        country VARCHAR(150) NOT NULL,
        PRIMARY KEY(id_relay_point)
    );

CREATE TABLE
    SHIPPING_ADDRESS(
        id_shipping_address INT AUTO_INCREMENT,
        city VARCHAR(150) NOT NULL,
        country VARCHAR(150) NOT NULL,
        zip_code INT NOT NULL,
        address VARCHAR(255) NOT NULL,
        PRIMARY KEY(id_shipping_address)
    );

CREATE TABLE
    INGREDIENT(
        id_ingredient INT AUTO_INCREMENT,
        name VARCHAR(50),
        PRIMARY KEY(id_ingredient)
    );

CREATE TABLE
    PROVIDERS_FILES(
        id_providers_files INT AUTO_INCREMENT,
        file VARCHAR(255) NOT NULL,
        date_of_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id_providers_files)
    );

CREATE TABLE
    PROVIDERS_IMAGES(
        id_providers_images INT AUTO_INCREMENT,
        image VARCHAR(255) NOT NULL,
        date_of_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id_providers_images)
    );

CREATE TABLE
    ADDRESS_COURSES(
        id_address_courses INT AUTO_INCREMENT,
        address VARCHAR(200) NOT NULL,
        city VARCHAR(100) NOT NULL,
        zip_code VARCHAR(10) NOT NULL,
        country VARCHAR(200) NOT NULL,
        PRIMARY KEY(id_address_courses)
    );

CREATE TABLE
    JOB_TRAINING(
        id_job_training INT AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY(id_job_training)
    );

CREATE TABLE
    EVENT_TYPE(
        id_event_type INT AUTO_INCREMENT,
        name VARCHAR(255),
        description VARCHAR(255),
        PRIMARY KEY(id_event_type)
    );

CREATE TABLE
    SKILLS(
        id_skills INT AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        PRIMARY KEY(id_skills)
    );

CREATE TABLE
    CERTIFICATE(
        id_certificate INT AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        type TEXT,
        PRIMARY KEY(id_certificate)
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
        creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        mail_verified BOOLEAN NOT NULL DEFAULT 0,
        validation_code INT DEFAULT NULL,
        censure_tchat BOOLEAN NOT NULL DEFAULT TRUE,
        id_access INT NOT NULL,
        PRIMARY KEY(id_users),
        UNIQUE(email),
        FOREIGN KEY(id_access) REFERENCES ACCESS(id_access)
    );

CREATE TABLE
    USER_IP(
        id_user_ip INT AUTO_INCREMENT,
        ip VARCHAR(50) NOT NULL,
        id_users INT NOT NULL,
        PRIMARY KEY(id_user_ip),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE
    SUBSCRIPTION(
        id_subscription INT AUTO_INCREMENT,
        name VARCHAR(40) NOT NULL,
        is_active BOOLEAN NOT NULL,
        price_monthly DOUBLE NOT NULL,
        price_yearly DOUBLE NOT NULL,
        access_to_lessons INT,
        icon VARCHAR(255) NOT NULL,
        id_renewal_bonus INT,
        PRIMARY KEY(id_subscription),
        FOREIGN KEY(id_renewal_bonus) REFERENCES RENEWAL_BONUS(id_renewal_bonus)
    );

CREATE TABLE
    USER_NAVIGATION(
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
    EVENT_TEMPLATE(
        id_event_template INT AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        description TEXT,
        price DOUBLE NOT NULL DEFAULT 0,
        id_users INT NOT NULL,
        PRIMARY KEY(id_event_template),
        FOREIGN KEY(id_users) REFERENCES users(id_users)
    );

CREATE TABLE EVENT(ID_EVENT 
	INT AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	description TEXT,
	price DOUBLE NOT NULL DEFAULT 0,
	place INT NOT NULL,
	date_start DATETIME NOT NULL,
	date_end DATETIME NOT NULL,
	image VARCHAR(255),
	slug VARCHAR(50),
	id_users INT NOT NULL,
	PRIMARY KEY(id_event),
	FOREIGN KEY(id_users) REFERENCES users(id_users)
	);
	CREATE TABLE
	    LOCATION(
	        id_location INT AUTO_INCREMENT,
	        name VARCHAR(50) NOT NULL,
	        address VARCHAR(255) NOT NULL,
	        is_open BOOLEAN NOT NULL default TRUE,
	        available_to_rental BOOLEAN NOT NULL DEFAULT TRUE,
	        price_half_day DOUBLE NOT NULL DEFAULT 0,
	        price_day DOUBLE NOT NULL DEFAULT 0,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_location),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    EQUIPMENT(
	        id_equipment INT AUTO_INCREMENT,
	        name VARCHAR(100) NOT NULL,
	        description VARCHAR(50),
	        image VARCHAR(50),
	        allow_rental BOOLEAN NOT NULL DEFAULT TRUE,
	        allow_event BOOLEAN NOT NULL DEFAULT TRUE,
	        allow_purchase BOOLEAN NOT NULL DEFAULT TRUE,
	        price_purchase DOUBLE NOT NULL,
	        price_rental DOUBLE NOT NULL,
	        stock INT NOT NULL,
	        creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_equipment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    SHOPPING_CART(
	        id_shopping_cart INT AUTO_INCREMENT,
	        shipping_adress VARCHAR(255),
	        date_purchase DATETIME,
	        id_users INT NOT NULL,
	        id_relay_point INT NOT NULL,
	        id_shipping_address INT NOT NULL,
	        id_command_status INT NOT NULL,
	        PRIMARY KEY(id_shopping_cart),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_relay_point) REFERENCES RELAY_POINT(id_relay_point),
	        FOREIGN KEY(id_shipping_address) REFERENCES SHIPPING_ADDRESS(id_shipping_address),
	        FOREIGN KEY(id_command_status) REFERENCES COMMAND_STATUS(id_command_status)
	    );
	CREATE TABLE
	    TCHAT(
	        id_message INT AUTO_INCREMENT,
	        message VARCHAR(255) NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_message),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    COMMENT(
	        id_comment INT AUTO_INCREMENT,
	        content VARCHAR(255) NOT NULL,
	        stars INT NOT NULL,
	        id_users INT NOT NULL,
	        id_event INT NOT NULL,
	        PRIMARY KEY(id_comment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event)
	    );
	CREATE TABLE
	    RECIPES(
	        id_recipes INT AUTO_INCREMENT,
	        image VARCHAR(255),
	        name VARCHAR(50) NOT NULL,
	        description TEXT,
	        type INT NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_recipes),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    WORDS(
	        id_words INT AUTO_INCREMENT,
	        word VARCHAR(100) NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_words),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    AVATAR(
	        id_avatar INT AUTO_INCREMENT,
	        head VARCHAR(50) NOT NULL,
	        eyes VARCHAR(50) NOT NULL,
	        mouth VARCHAR(50) NOT NULL,
	        noze VARCHAR(50) NOT NULL,
	        hairs VARCHAR(50) NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_avatar),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    IMAGES_LOCATION(
	        id_images INT AUTO_INCREMENT,
	        image VARCHAR(255) NOT NULL,
	        id_location INT NOT NULL,
	        PRIMARY KEY(id_images),
	        FOREIGN KEY(id_location) REFERENCES LOCATION(id_location)
	    );
	CREATE TABLE
	    PROVIDERS(
	        id_providers INT AUTO_INCREMENT,
	        description TEXT,
	        siret VARCHAR(50),
	        verified BOOLEAN,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_providers),
	        UNIQUE(id_users),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    COURSES(
	        id_courses INT AUTO_INCREMENT,
	        special_request TEXT,
	        date_of_courses DATETIME NOT NULL,
	        statut INT,
	        link VARCHAR(255),
	        type INT,
	        id_providers INT NOT NULL,
	        id_users INT NOT NULL,
	        PRIMARY KEY(id_courses),
	        FOREIGN KEY(id_providers) REFERENCES PROVIDERS(id_providers),
	        FOREIGN KEY(id_users) REFERENCES users(id_users)
	    );
	CREATE TABLE
	    WORKSHOP(
	        id_workshop INT AUTO_INCREMENT,
	        description TEXT,
	        name VARCHAR(255) NOT NULL,
	        image VARCHAR(255),
	        price DOUBLE NOT NULL,
	        date_start DATETIME NOT NULL,
	        date_end DATETIME NOT NULL,
	        nb_place INT NOT NULL,
	        id_location INT NOT NULL,
	        PRIMARY KEY(id_workshop),
	        FOREIGN KEY(id_location) REFERENCES LOCATION(id_location)
	    );
	CREATE TABLE
	    DELIVER_TO(
	        id_subscription INT,
	        id_shipping_type INT,
	        PRIMARY KEY(
	            id_subscription,
	            id_shipping_type
	        ),
	        FOREIGN KEY(id_subscription) REFERENCES SUBSCRIPTION(id_subscription),
	        FOREIGN KEY(id_shipping_type) REFERENCES SHIPPING_TYPE(id_shipping_type)
	    );
	CREATE TABLE
	    SPONSORS(
	        id_subscription INT,
	        id_rewards INT,
	        PRIMARY KEY(id_subscription, id_rewards),
	        FOREIGN KEY(id_subscription) REFERENCES SUBSCRIPTION(id_subscription),
	        FOREIGN KEY(id_rewards) REFERENCES REWARDS(id_rewards)
	    );
	CREATE TABLE
	    GIVE_ACCESS_TO(
	        id_subscription INT,
	        id_subscription_option INT,
	        PRIMARY KEY(
	            id_subscription,
	            id_subscription_option
	        ),
	        FOREIGN KEY(id_subscription) REFERENCES SUBSCRIPTION(id_subscription),
	        FOREIGN KEY(id_subscription_option) REFERENCES SUBSCRIPTION_OPTION(id_subscription_option)
	    );
	CREATE TABLE
	    SUBSCRIBE_TO(
	        id_users INT,
	        id_subscription INT,
	        type_of_payement VARCHAR(50) NOT NULL,
	        date_of_buy DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_subscription),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_subscription) REFERENCES SUBSCRIPTION(id_subscription)
	    );
	CREATE TABLE
	    OPENS_AT(
	        id_location INT,
	        id_opening_hours INT,
	        PRIMARY KEY(id_location, id_opening_hours),
	        FOREIGN KEY(id_location) REFERENCES LOCATION(id_location),
	        FOREIGN KEY(id_opening_hours) REFERENCES OPENING_HOURS(id_opening_hours)
	    );
	CREATE TABLE
	    TAKE_PLACE(
	        id_event INT,
	        id_location INT,
	        PRIMARY KEY(id_event, id_location),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event),
	        FOREIGN KEY(id_location) REFERENCES LOCATION(id_location)
	    );
	CREATE TABLE
	    USE_EQUIPMENT(
	        id_event INT,
	        id_equipment INT,
	        PRIMARY KEY(id_event, id_equipment),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event),
	        FOREIGN KEY(id_equipment) REFERENCES EQUIPMENT(id_equipment)
	    );
	CREATE TABLE
	    RENT_LOCATION(
	        id_users INT,
	        id_location INT,
	        start_rental DATETIME NOT NULL,
	        date_reservation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	        end_rental DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_location),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_location) REFERENCES LOCATION(id_location)
	    );
	CREATE TABLE
	    RENT_EQUIPMENT(
	        id_users INT,
	        id_equipment INT,
	        start_rental DATETIME NOT NULL,
	        end_rental DATETIME NOT NULL,
	        PRIMARY KEY(id_users, id_equipment),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_equipment) REFERENCES EQUIPMENT(id_equipment)
	    );
	CREATE TABLE
	    JOIN_EVENT(
	        id_users INT,
	        id_event INT,
	        PRIMARY KEY(id_users, id_event),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event)
	    );
	CREATE TABLE
	    PROVIDERS_OCCURS(
	        id_users INT,
	        id_event INT,
	        salary DOUBLE NOT NULL,
	        PRIMARY KEY(id_users, id_event),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event)
	    );
	CREATE TABLE
	    CONTAINS(
	        id_equipment INT,
	        id_shopping_cart INT,
	        quantity INT,
	        PRIMARY KEY(
	            id_equipment,
	            id_shopping_cart
	        ),
	        FOREIGN KEY(id_equipment) REFERENCES EQUIPMENT(id_equipment),
	        FOREIGN KEY(id_shopping_cart) REFERENCES SHOPPING_CART(id_shopping_cart)
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
	    IS_OPEN_AT(
	        id_opening_hours INT,
	        id_relay_point INT,
	        PRIMARY KEY(
	            id_opening_hours,
	            id_relay_point
	        ),
	        FOREIGN KEY(id_opening_hours) REFERENCES OPENING_HOURS(id_opening_hours),
	        FOREIGN KEY(id_relay_point) REFERENCES RELAY_POINT(id_relay_point)
	    );
	CREATE TABLE
	    USED(
	        id_recipes INT,
	        id_ingredient INT,
	        quantity VARCHAR(255),
	        PRIMARY KEY(id_recipes, id_ingredient),
	        FOREIGN KEY(id_recipes) REFERENCES RECIPES(id_recipes),
	        FOREIGN KEY(id_ingredient) REFERENCES INGREDIENT(id_ingredient)
	    );
	CREATE TABLE
	    ADD_FILES(
	        id_providers INT,
	        id_providers_files INT,
	        PRIMARY KEY(
	            id_providers,
	            id_providers_files
	        ),
	        FOREIGN KEY(id_providers) REFERENCES PROVIDERS(id_providers),
	        FOREIGN KEY(id_providers_files) REFERENCES PROVIDERS_FILES(id_providers_files)
	    );
	CREATE TABLE
	    OF_TYPE(
	        id_providers_type INT,
	        id_providers INT,
	        PRIMARY KEY(
	            id_providers_type,
	            id_providers
	        ),
	        FOREIGN KEY(id_providers_type) REFERENCES PROVIDERS_TYPE(id_providers_type),
	        FOREIGN KEY(id_providers) REFERENCES PROVIDERS(id_providers)
	    );
	CREATE TABLE
	    ADD_IMAGES(
	        id_providers INT,
	        id_providers_images INT,
	        PRIMARY KEY(
	            id_providers,
	            id_providers_images
	        ),
	        FOREIGN KEY(id_providers) REFERENCES PROVIDERS(id_providers),
	        FOREIGN KEY(id_providers_images) REFERENCES PROVIDERS_IMAGES(id_providers_images)
	    );
	CREATE TABLE
	    CHOOSE(
	        id_recipes INT,
	        id_courses INT,
	        PRIMARY KEY(id_recipes, id_courses),
	        FOREIGN KEY(id_recipes) REFERENCES RECIPES(id_recipes),
	        FOREIGN KEY(id_courses) REFERENCES COURSES(id_courses)
	    );
	CREATE TABLE
	    RECIPES_USE(
	        id_equipment INT,
	        id_recipes INT,
	        PRIMARY KEY(id_equipment, id_recipes),
	        FOREIGN KEY(id_equipment) REFERENCES EQUIPMENT(id_equipment),
	        FOREIGN KEY(id_recipes) REFERENCES RECIPES(id_recipes)
	    );
	CREATE TABLE
	    COURSES_TAKE_PLACE(
	        id_courses INT,
	        id_address_courses INT,
	        PRIMARY KEY(
	            id_courses,
	            id_address_courses
	        ),
	        FOREIGN KEY(id_courses) REFERENCES COURSES(id_courses),
	        FOREIGN KEY(id_address_courses) REFERENCES ADDRESS_COURSES(id_address_courses)
	    );
	CREATE TABLE
	    IS_OF_TYPE(
	        id_event INT,
	        id_event_type INT,
	        PRIMARY KEY(id_event, id_event_type),
	        FOREIGN KEY(id_event) REFERENCES EVENT(id_event),
	        FOREIGN KEY(id_event_type) REFERENCES EVENT_TYPE(id_event_type)
	    );
	CREATE TABLE
	    COMPOSED(
	        id_recipes INT,
	        id_workshop INT,
	        PRIMARY KEY(id_recipes, id_workshop),
	        FOREIGN KEY(id_recipes) REFERENCES RECIPES(id_recipes),
	        FOREIGN KEY(id_workshop) REFERENCES WORKSHOP(id_workshop)
	    );
	CREATE TABLE
	    user_join_workshop(
	        id_users INT,
	        id_workshop INT,
	        PRIMARY KEY(id_users, id_workshop),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_workshop) REFERENCES WORKSHOP(id_workshop)
	    );
	CREATE TABLE
	    WILL_CONTAINS_WORKSHOP(
	        id_job_training INT,
	        id_workshop INT,
	        PRIMARY KEY(id_job_training, id_workshop),
	        FOREIGN KEY(id_job_training) REFERENCES JOB_TRAINING(id_job_training),
	        FOREIGN KEY(id_workshop) REFERENCES WORKSHOP(id_workshop)
	    );
	CREATE TABLE
	    WORK(
	        id_workshop INT,
	        id_skills INT,
	        PRIMARY KEY(id_workshop, id_skills),
	        FOREIGN KEY(id_workshop) REFERENCES WORKSHOP(id_workshop),
	        FOREIGN KEY(id_skills) REFERENCES SKILLS(id_skills)
	    );
	CREATE TABLE
	    user_join_job_training(
	        id_users INT,
	        id_job_training INT,
	        PRIMARY KEY(id_users, id_job_training),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_job_training) REFERENCES JOB_TRAINING(id_job_training)
	    );
	CREATE TABLE
	    ON_VALIDATE(
	        id_skills INT,
	        id_certificate INT,
	        PRIMARY KEY(id_skills, id_certificate),
	        FOREIGN KEY(id_skills) REFERENCES SKILLS(id_skills),
	        FOREIGN KEY(id_certificate) REFERENCES CERTIFICATE(id_certificate)
	    );
	CREATE TABLE
	    OPTAINS(
	        id_users INT,
	        id_certificate INT,
	        PRIMARY KEY(id_users, id_certificate),
	        FOREIGN KEY(id_users) REFERENCES users(id_users),
	        FOREIGN KEY(id_certificate) REFERENCES CERTIFICATE(id_certificate)
	    );
	CREATE TABLE
	    PROVIDERS_JOIN_WORKSHOP(
	        id_providers INT,
	        id_workshop INT,
	        PRIMARY KEY(id_providers, id_workshop),
	        FOREIGN KEY(id_providers) REFERENCES PROVIDERS(id_providers),
	        FOREIGN KEY(id_workshop) REFERENCES WORKSHOP(id_workshop)
	    );
