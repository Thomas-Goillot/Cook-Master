package cookmaster.dashboard;

import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class PasswordHasher {
    private static final int PASSWORD_COST = 12;
    private static final String PASSWORD_SALT = "cookmaster";

    public static String hashPassword(String password) {
        try {
            MessageDigest digest = MessageDigest.getInstance("SHA-256");

            for (int i = 0; i < PASSWORD_COST; i++) {
                password = bytesToHexString(digest.digest((password + PASSWORD_SALT).getBytes(StandardCharsets.UTF_8)));
            }

            return password;
        } catch (NoSuchAlgorithmException e) {
            System.out.println("Erreur lors de l'initialisation de l'algorithme de hachage : " + e.getMessage());
        }

        return null;
    }

    private static String bytesToHexString(byte[] bytes) {
        StringBuilder hexString = new StringBuilder();
        for (byte b : bytes) {
            String hex = String.format("%02x", b);
            hexString.append(hex);
        }
        return hexString.toString();
    }
}