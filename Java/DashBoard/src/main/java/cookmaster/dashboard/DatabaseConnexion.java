package cookmaster.dashboard;

import java.sql.*;


public class DatabaseConnexion {

    // Informations de connexion à la base de données
    private static final String DB_URL = "jdbc:mysql://sportplus.ddns.net:3306/cookedmaster_dev";
    private static final String DB_USER = "cookedmaster_dev";
    private static final String DB_PASSWORD = "lk994jQZaAIDsggS";

    private int userId;

    // Objet de connexion à la base de données
    private static Connection connection;

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    // Méthode pour établir la connexion
    public void connect() {
        try {
            // Charger le pilote JDBC
            Class.forName("com.mysql.cj.jdbc.Driver");

            // Établir la connexion à la base de données
            connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);

            System.out.println("Connexion à la base de données réussie!");
        } catch (ClassNotFoundException | SQLException e) {
            System.out.println("Erreur lors de la connexion à la base de données: " + e.getMessage());
        }
    }

    // Méthode pour fermer la connexion
    public void disconnect() {
        try {
            if (connection != null) {
                connection.close();
                System.out.println("Connexion à la base de données fermée!");
            }
        } catch (SQLException e) {
            System.out.println("Erreur lors de la fermeture de la connexion à la base de données: " + e.getMessage());
        }
    }

    public int checkUserIsAdmin(String email, String password) {
        String query = "SELECT * FROM users WHERE email = ? AND password = ? AND id_access = 2";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, email);
            preparedStatement.setString(2, password);
            ResultSet resultSet = preparedStatement.executeQuery();
            //return the id_users if the user is admin
            if (resultSet.next()) {
                return resultSet.getInt("id_users");
            } else {
                return 0;
            }

        } catch (SQLException e) {
            System.out.println("Erreur lors de la vérification de l'utilisateur: " + e.getMessage());
            return 0;
        }
    }

    public User getUserById(int id) {
        String query = "SELECT * FROM users WHERE id_users = ?";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setInt(1, id);
            ResultSet resultSet = preparedStatement.executeQuery();

            if (resultSet.next()) {
                // Récupérer les valeurs du ResultSet
                int userId = resultSet.getInt("id_users");
                String firstName = resultSet.getString("name");
                String lastName = resultSet.getString("surname");

                // Créer un objet User avec les valeurs récupérées
                User user = new User(userId, firstName, lastName);
                return user;
            } else {
                return null; // Aucun utilisateur trouvé avec cet ID
            }

        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération de l'utilisateur : " + e.getMessage());
            return null;
        }
    }

    public ResultSet getAllUserWithSubscriptionName() {
        String query = "SELECT users.*, subscription.name AS subscription_name FROM users INNER JOIN subscribe_to ON users.id_users = subscribe_to.id_users INNER JOIN subscription ON subscribe_to.id_subscription = subscription.id_subscription";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            ResultSet resultSet = preparedStatement.executeQuery();
            return resultSet;
        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération des utilisateurs : " + e.getMessage());
            return null;
        }
    }

    public int getNumberOfUsers(){
        String query = "SELECT COUNT(users.id_users) as counterUser FROM users";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            ResultSet resultSet = preparedStatement.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt("counterUser");
            } else {
                return 0;
            }
        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération du nombre d'utilisateurs : " + e.getMessage());
            return 0;
        }
    }

    public int getNumberOfRh() {
        String query = "SELECT COUNT(users.id_users) as counterRh FROM users WHERE id_access = 3";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            ResultSet resultSet = preparedStatement.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt("counterRh");
            } else {
                return 0;
            }
        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération du nombre de RH : " + e.getMessage());
            return 0;
        }
    }

    public int getNumberOfProviders() {
        String query = "SELECT COUNT(providers.id_users) as counterProvider FROM providers WHERE verified = 1";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            ResultSet resultSet = preparedStatement.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt("counterProvider");
            } else {
                return 0;
            }
        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération du nombre de fournisseurs : " + e.getMessage());
            return 0;
        }
    }

    public ResultSet getAllEvent() {
        String query = "SELECT * FROM event";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            ResultSet resultSet = preparedStatement.executeQuery();
            return resultSet;
        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération des évènements : " + e.getMessage());
            return null;
        }
    }
}
