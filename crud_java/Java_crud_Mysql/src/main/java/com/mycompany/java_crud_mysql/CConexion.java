/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.java_crud_mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import javax.swing.JOptionPane;

/**
 *
 * @author maso
 */
public class CConexion {
    
    Connection conectar= null;
    
    String usuario="root";
    String contrasenya="";
    String bd="java";
    String ip="localhost";
    String puerto="3306";
    
    String cadena= "jdbc:mysql://"+ip+":"+puerto+"/"+bd;
    
    public Connection estableceConexion(){
        
        try{
            
            Class.forName("com.mysql.cj.jdbc.Driver");
            
            conectar= DriverManager.getConnection(cadena, usuario, contrasenya);
            
            //JOptionPane.showMessageDialog(null, "La conexion se ha realizado con éxito");
            
        }catch (Exception e){
            
            JOptionPane.showMessageDialog(null, "error al conectarse a la base de datos"+e.toString());
        }
        
        return conectar;
    }
}
