package hg.webshop.util;

import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Part;

@WebServlet("/FileUploadServlet")
@MultipartConfig(fileSizeThreshold=1024*1024*2, // 2MB
             maxFileSize=1024*1024*2,      // 2MB
             maxRequestSize=1024*1024*50)

public class FileUploadServlet extends HttpServlet {
private static final String SAVE_DIR="images";

protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
	System.out.println("FELTÖLTÉS");
    response.setContentType("text/html;charset=UTF-8");
    PrintWriter out = response.getWriter();
        String savePath = getServletContext().getRealPath("/") + File.separator + SAVE_DIR; //specify your path here
            File fileSaveDir=new File(savePath);
            if(!fileSaveDir.exists()){
                fileSaveDir.mkdir();
            }

        Part part=request.getPart("file");
        String fileName=extractFileName(part);
        part.write(savePath + File.separator + fileName);

}
// file name of the upload file is included in content-disposition header like this:
//form-data; name="dataFile"; filename="PHOTO.JPG"
private String extractFileName(Part part) {
    String contentDisp = part.getHeader("content-disposition");
    String[] items = contentDisp.split(";");
    for (String s : items) {
        if (s.trim().startsWith("filename")) {
            return s.substring(s.indexOf("=") + 2, s.length()-1);
        }
    }
    return "";
}
}