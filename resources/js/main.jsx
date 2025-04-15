import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import App from "./App"; 
import TableCocktails from "./components/tablecocktails"; 

// Recupera los cócteles inyectados en la variable global
const initialCocktails = window.initialCocktails || [];

// Si existe contenedor con id "manage-root", renderiza la vista de gestión.
const manageContainer = document.getElementById("manage-root");
if (manageContainer) {
    const root = createRoot(manageContainer);
    root.render(
        <StrictMode>
            <TableCocktails cocktails={initialCocktails} />
        </StrictMode>
    );
} else {
    // Sino, renderiza el componente home en "root"
    const container = document.getElementById("root");
    if (container) {
        const root = createRoot(container);
        root.render(
            <StrictMode>
                <App cocktails={initialCocktails} />
            </StrictMode>
        );
    } else {
        console.error("No se encontró el contenedor adecuado");
    }
}