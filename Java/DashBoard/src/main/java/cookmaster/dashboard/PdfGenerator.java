package cookmaster.dashboard;

import java.awt.Color;
import java.io.IOException;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;
import org.apache.pdfbox.pdmodel.common.PDRectangle;
import org.apache.pdfbox.pdmodel.font.PDType1Font;
import java.awt.geom.GeneralPath;

public class PdfGenerator {
    public static void main(String[] args) {
        try {
            PDDocument document = new PDDocument();
            PDPage page = new PDPage(PDRectangle.A4);
            document.addPage(page);

            PDPageContentStream contentStream = new PDPageContentStream(document, page);

            // Générer le diagramme à barres
            generateBarChart(contentStream);

            contentStream.close();

            document.save("output.pdf");
            document.close();

            System.out.println("Le fichier PDF a été généré avec succès.");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static void generateBarChart(PDPageContentStream contentStream) throws IOException {
        float startX = 100;
        float startY = 700;
        float width = 400;
        float height = 200;

        // Dessiner l'axe des x
        contentStream.moveTo(startX, startY);
        contentStream.lineTo(startX + width, startY);
        contentStream.stroke();

        // Dessiner l'axe des y
        contentStream.moveTo(startX, startY);
        contentStream.lineTo(startX, startY - height);
        contentStream.stroke();

        // Dessiner les barres du diagramme
        drawBar(contentStream, startX + 50, startY, 100, 50, Color.BLUE);
        drawBar(contentStream, startX + 150, startY, 200, 50, Color.GREEN);
        drawBar(contentStream, startX + 250, startY, 150, 50, Color.RED);

        // Ajouter des étiquettes
        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
        contentStream.beginText();
        contentStream.newLineAtOffset(startX + 50, startY + 20);
        contentStream.showText("Catégorie 1");
        contentStream.newLineAtOffset(100, 0);
        contentStream.showText("Catégorie 2");
        contentStream.newLineAtOffset(100, 0);
        contentStream.showText("Catégorie 3");
        contentStream.endText();
    }

    private static void drawBar(PDPageContentStream contentStream, float x, float y, float width, float height, Color color) throws IOException {
        contentStream.setNonStrokingColor(color);
        contentStream.addRect(x, y, width, height);
        contentStream.fill();
    }

}


