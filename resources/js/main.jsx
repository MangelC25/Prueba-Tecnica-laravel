import React, { StrictMode } from "react";
import App from "./app";
import { createRoot } from "react-dom/client";

// Recupera los cócteles inyectados en la variable global
const initialCocktails = window.initialCocktails || [];

const container = document.getElementById("react-root");
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(
    <StrictMode>
        <App cocktails={initialCocktails} />
    </StrictMode>
);
