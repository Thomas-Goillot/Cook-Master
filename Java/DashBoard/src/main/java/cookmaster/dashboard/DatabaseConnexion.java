package cookmaster.dashboard;

import java.sql.*;



public class DatabaseConnexion {

    // Informations de connexion à la base de données
    private static final String DB_URL = "jdbc:mysql://sportplus.ddns.net:3306/cookedmaster_dev";
    private static final String DB_USER = "cookedmaster_dev";
    private static final String DB_PASSWORD = "lk994jQZaAIDsggS";

    // Objet de connexion à la base de données
    private static Connection connection;

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

    public boolean checkUserIsAdmin(String email, String password) {
        String query = "SELECT * FROM users WHERE email = ? AND password = ?";
        try {
            PreparedStatement preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, email);
            preparedStatement.setString(2, password);
            ResultSet resultSet = preparedStatement.executeQuery();
            return resultSet.next();
        } catch (SQLException e) {
            System.out.println("Erreur lors de la vérification de l'utilisateur: " + e.getMessage());
            return false;
        }
    }
}
