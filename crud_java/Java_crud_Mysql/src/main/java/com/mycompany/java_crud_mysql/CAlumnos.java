/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.java_crud_mysql;

import javax.swing.JOptionPane;
import javax.swing.JTextField;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import javax.swing.table.TableRowSorter;

/**
 *
 * @author maso
 */
public class CAlumnos {
    
    //VARIABLES
    int id;
    String nombre;
    int edad;

    //SET Y GET ID
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    // SET Y GET NOMBRE
    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    //SET Y GET EDAD
    public int getEdad() {
        return edad;
    }

    public void setEdad(int edad) {
        this.edad = edad;
    }
    
    
    public void insertarAlumno(JTextField paramNombre, JTextField paramEdad){
        
        setNombre(paramNombre.getText());
        
        int edad= Integer.parseInt(paramEdad.getText());
        setEdad(edad);
        
        CConexion objetoConexion= new CConexion();
        
        String consulta= "insert into alumnos (nombre, edad) values (?, ?);";
        
        try {
            
            CallableStatement cs= objetoConexion.estableceConexion().prepareCall(consulta);
            
            cs.setString(1, getNombre());
            cs.setInt(2, getEdad());
            
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Se ha insertado correctamente");
            
        } catch (Exception e) {
            
            JOptionPane.showMessageDialog(null, "No se ha insertado correctamente. Error: "+e.toString());
        }
        
    }
    
    public void mostrarAlumnos(JTable paramTablaAlumnos){
        
        CConexion objetoConexion= new CConexion();
        
        DefaultTableModel modelo= new DefaultTableModel();
        
        TableRowSorter<TableModel> OrdenarTabla= new TableRowSorter<TableModel>(modelo);
        
        paramTablaAlumnos.setRowSorter(OrdenarTabla);
        
        String[] datos= new String[3];
        
        String sql="";
        
        modelo.addColumn("id");
        modelo.addColumn("nombre");
        modelo.addColumn("edad");
        
        paramTablaAlumnos.setModel(modelo);
        
        sql="select * from alumnos";
        
        Statement st;
        
        try {
            
            st= objetoConexion.estableceConexion().createStatement();
            
            ResultSet rs= st.executeQuery(sql);
            
            while(rs.next()){
                
                datos[0]= rs.getString(1);
                datos[1]= rs.getString(2);
                datos[2]= rs.getString(3);
                
                modelo.addRow(datos);
                
            }
            
            paramTablaAlumnos.setModel(modelo);
            
        } catch (Exception e) {
            
            JOptionPane.showMessageDialog(null, "No se ha podido mostrar los datos. Error: "+e.toString());
        }
        
    }
    
    public void SeleccionarAlumnos(JTable paramTablaAlumnos, JTextField paramID, JTextField paramNombre, JTextField paramEdad){
    
    
        try {
            
            int fila= paramTablaAlumnos.getSelectedRow();
            
            if(fila >=0){
                
                paramID.setText((paramTablaAlumnos.getValueAt(fila, 0).toString()));
                paramNombre.setText((paramTablaAlumnos.getValueAt(fila, 1).toString()));
                paramEdad.setText((paramTablaAlumnos.getValueAt(fila, 2).toString()));
            }else{
                JOptionPane.showMessageDialog(null, "Fila no seleccionada");
            }
            
            
        } catch (Exception e) {
            
            JOptionPane.showMessageDialog(null, "No se ha podido seleccionar los datos. Error: "+e.toString());
        }
    
    
    }
    
    public void ModificarAlumnos(JTextField paramCodigo, JTextField paramNombre, JTextField paramEdad){
        
        setId(Integer.parseInt(paramCodigo.getText()));
        setNombre(paramNombre.getText());
        setEdad(Integer.parseInt(paramEdad.getText()));
        
        
        CConexion objetoConexion= new CConexion();
        
        String consulta="update alumnos set alumnos.nombre=?, alumnos.edad=? where alumnos.id=?;";
     
        
        try {
            
            CallableStatement cs= objetoConexion.estableceConexion().prepareCall(consulta);
            
            //LOS NUMEROS QUE APARECEN PRIMERO SON EL ORDEN DE LOS SIGNOS DE INTERROGACIÓN ?
            cs.setString(1, getNombre());
            cs.setInt(2, getEdad());
            cs.setInt(3, getId());
            
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Se ha modificado correctamente");
            
        } catch (SQLException e) {
            
            JOptionPane.showMessageDialog(null, "No se ha podido modificar los datos. Error: "+e.toString());
        }
    }
    
    public void EliminarAlumnos(JTextField paramCodigo){
        
         setId(Integer.parseInt(paramCodigo.getText()));
         
          CConexion objetoConexion= new CConexion();
          
          String consulta="delete from alumnos where alumnos.id=?;";
          
          try {
            
            CallableStatement cs= objetoConexion.estableceConexion().prepareCall(consulta);
            
            cs.setInt(1, getId());
            
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Se ha eliminado correctamente");
            
        } catch (SQLException e) {
            
            JOptionPane.showMessageDialog(null, "No se ha podido eliminar los datos. Error: "+e.toString());
        }
    }
    

}
