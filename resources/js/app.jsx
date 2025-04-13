import React, { useEffect } from "react";
import $ from "jquery";
import "datatables.net";

const App = ({ cocktails = [] }) => {
    useEffect(() => {
        $("#cocktail-table").DataTable();
    }, [cocktails]);

    return (
        <div className="container">
            <h1>Cocktails</h1>

            <table
                id="cocktail-table"
                className="table table-striped table-bordered"
            >
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Vasos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {cocktails.map((c, index) => (
                        <tr key={index}>
                            <td>{c.strDrink}</td>
                            <td>{c.strCategory}</td>
                            <td>{c.strGlass}</td>
                            <td>
                                <button onClick={() => handleGuardar(c)}>
                                    Guardar
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default App;
