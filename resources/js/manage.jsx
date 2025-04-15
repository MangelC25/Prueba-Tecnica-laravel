import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import TableCocktails from "./components/tablecocktails"; 

// Recupera los cócteles inyectados en la variable global desde Blade
const initialCocktails = window.initialCocktails || [];

// Renderiza el componente en el contenedor con id "manage-root"
const container = document.getElementById("manage-root");
if (container) {
  const root = createRoot(container);
  root.render(
    <StrictMode>
      <TableCocktails cocktails={initialCocktails} />
    </StrictMode>
  );
} else {
  console.error("No se encontró el contenedor manage-root");
}