package com.huonu.utils.excel;
import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.URLEncoder;
import java.util.List;

import javax.servlet.http.HttpServletResponse;

import org.apache.poi.xssf.usermodel.XSSFCell;
import org.apache.poi.xssf.usermodel.XSSFCellStyle;
import org.apache.poi.xssf.usermodel.XSSFDataFormat;
import org.apache.poi.xssf.usermodel.XSSFRow;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

public class ExcelUtils {
	
	// private SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	    /**
	     *tempPath 模板文件路径
	     *path 文件路径
	     *list 集合数据
	     */
	    public void exportExcel(String tempPath, String path, HttpServletResponse response, List<ExcelModel> list) {
	        File newFile = createNewFile(tempPath, path);
	        InputStream is = null;
	        XSSFWorkbook workbook = null;
	        XSSFSheet sheet = null;
	        try {
	            is = new FileInputStream(newFile);// 将excel文件转为输入流
	            workbook = new XSSFWorkbook(is);// 创建个workbook，
	            // 获取第一个sheet
	            sheet = workbook.getSheetAt(0);
	        } catch (Exception e1) {
	            e1.printStackTrace();
	        }

	        if (sheet != null) {
	            try {
	                // 写数据
	                FileOutputStream fos = new FileOutputStream(newFile);
	                XSSFRow row = sheet.getRow(0);
	                if (row == null) {
	                    row = sheet.createRow(0);
	                }
	                XSSFCell cell = row.getCell(0);
	                if (cell == null) {
	                    cell = row.createCell(0);
	                }

	                XSSFCellStyle borderStyle = workbook.createCellStyle();
	                XSSFDataFormat format = workbook.createDataFormat();
	                borderStyle.setDataFormat(format.getFormat("#,##0.00"));
	                
	                for (int i = 0; i < list.size(); i++) {
	                    ExcelModel vo = list.get(i);
	                    row = sheet.createRow(i+1); //从第三行开始

	                    //根据excel模板格式写入数据....
	                    createRowAndCell(vo.getA(), row, cell, 0,false,borderStyle);
	                    createRowAndCell(vo.getB(), row, cell, 1,false,borderStyle);
	                    createRowAndCell(vo.getC(), row, cell, 2,false,borderStyle);
	                    createRowAndCell(vo.getD(), row, cell, 3,true,borderStyle);
	                    createRowAndCell(vo.getE(), row, cell, 4,true,borderStyle);
	                    createRowAndCell(vo.getF(), row, cell, 5,true,borderStyle);
	                    createRowAndCell(vo.getG(), row, cell, 6,true,borderStyle);
	                    createRowAndCell(vo.getH(), row, cell, 7,true,borderStyle);
	                    createRowAndCell(vo.getI(), row, cell, 8,true,borderStyle);
	                    createRowAndCell(vo.getJ(), row, cell, 9,true,borderStyle);
	                   
	                }
	                workbook.write(fos);
	                fos.flush();
	                fos.close();

	                // 下载
	                InputStream fis = new BufferedInputStream(new FileInputStream(
	                        newFile));
	                byte[] buffer = new byte[fis.available()];
	                fis.read(buffer);
	                fis.close();
	                response.reset();
	                response.setContentType("text/html;charset=UTF-8");
	                OutputStream toClient = new BufferedOutputStream(
	                        response.getOutputStream());
	                response.setContentType("application/x-msdownload");
	                String newName = URLEncoder.encode(
	                        "订单" + System.currentTimeMillis() + ".xlsx",
	                        "UTF-8");
	                response.addHeader("Content-Disposition",
	                        "attachment;filename=\"" + newName + "\"");
	                response.addHeader("Content-Length", "" + newFile.length());
	                toClient.write(buffer);
	                toClient.flush();
	            } catch (Exception e) {
	                e.printStackTrace();
	            } finally {
	                try {
	                    if (null != is) {
	                        is.close();
	                    }
	                } catch (Exception e) {
	                    e.printStackTrace();
	                }
	            }
	        }
	        // 删除创建的新文件
	        this.deleteFile(newFile);
	    }

	    /**
	     *根据当前row行，来创建index标记的列数,并赋值数据
	     */
	    private void createRowAndCell(Object obj, XSSFRow row, XSSFCell cell, int index,Boolean isNumber,XSSFCellStyle borderStyle ) {
	        cell = row.getCell(index);
	        if (cell == null) {
	            cell = row.createCell(index);
	        }
	        
	        if (obj != null){
	        	if(isNumber){
	        		cell.setCellStyle(borderStyle);
	        		cell.setCellValue(Double.parseDouble(obj.toString()));
	        	}else{
	        		cell.setCellValue(obj.toString());
	        	}
	        }else{
	            cell.setCellValue("");
	        }
	        
	    }

	    /**
	     * 复制文件
	     * 
	     * @param s
	     *            源文件
	     * @param t
	     *            复制到的新文件
	     */

	    public void fileChannelCopy(File s, File t) {
	        try {
	            InputStream in = null;
	            OutputStream out = null;
	            try {
	                in = new BufferedInputStream(new FileInputStream(s), 1024);
	                out = new BufferedOutputStream(new FileOutputStream(t), 1024);
	                byte[] buffer = new byte[1024];
	                int len;
	                while ((len = in.read(buffer)) != -1) {
	                    out.write(buffer, 0, len);
	                }
	            } finally {
	                if (null != in) {
	                    in.close();
	                }
	                if (null != out) {
	                    out.close();
	                }
	            }
	        } catch (Exception e) {
	            e.printStackTrace();
	        }
	    }


	    /**
	     * 读取excel模板，并复制到新文件中供写入和下载
	     * 
	     * @return
	     */
	    public File createNewFile(String tempPath, String rPath) {
	        // 读取模板，并赋值到新文件************************************************************
	        // 文件模板路径
	        String path = (tempPath);
	        File file = new File(path);
	        // 保存文件的路径
	        String realPath = rPath;
	        // 新的文件名
	        String newFileName = System.currentTimeMillis() + ".xlsx";
	        // 判断路径是否存在
	        File dir = new File(realPath);
	        if (!dir.exists()) {
	            dir.mkdirs();
	        }
	        // 写入到新的excel
	        File newFile = new File(realPath, newFileName);
	        try {
	            newFile.createNewFile();
	            // 复制模板到新文件
	            fileChannelCopy(file, newFile);
	        } catch (Exception e) {
	            e.printStackTrace();
	        }
	        return newFile;
	    }

	    /**
	     * 下载成功后删除
	     * 
	     * @param files
	     */
	    private void deleteFile(File... files) {
	        for (File file : files) {
	            if (file.exists()) {
	                file.delete();
	            }
	        }
	    }

}
