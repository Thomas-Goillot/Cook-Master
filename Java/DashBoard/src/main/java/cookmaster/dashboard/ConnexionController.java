package cookmaster.dashboard;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import static cookmaster.dashboard.PasswordHasher.hashPassword;

public class ConnexionController {

    @FXML
    private Button closeButton;

    @FXML
    private TextField email;

    @FXML
    private PasswordField password;

    private DatabaseConnexion databaseConnexion;

    public void initialize() {
        databaseConnexion = new DatabaseConnexion();
        databaseConnexion.connect();
    }
    @FXML
    public void handleConnexionButtonClicked() throws IOException, NoSuchAlgorithmException {

        String email = this.email.getText();
        String password = this.password.getText();

        String hashedPassword = hashPassword(password);

        boolean isAuthenticated = databaseConnexion.checkUserIsAdmin(email, password);
        System.out.println("isAuthenticated: " + isAuthenticated);
        if (isAuthenticated) {
            System.out.println("Connexion réussie!");
        } else {
            // Afficher un message d'erreur
            showErrorAlert("Identifiants incorrects", "Veuillez vérifier votre email et votre mot de passe.");
        }
    }

    @FXML
    public void handleCloseButtonClicked() {
        Stage stage = (Stage) closeButton.getScene().getWindow();
        stage.close();
    }

    private void showErrorAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public void disconnectDatabase() {
        // Fermer la connexion à la base de données lorsque vous avez terminé
        databaseConnexion.disconnect();
    }

    private void openDashboard() throws IOException {
        Parent fxmlLoader = FXMLLoader.load(getClass().getResource("dashboard.fxml"));
        Scene scene = new Scene(fxmlLoader);
        Stage stage = new Stage();
        Stage oldStage = (Stage) closeButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Dashboard");
        stage.initStyle(StageStyle.TRANSPARENT);
        stage.setScene(scene);
        stage.show();
    }
}