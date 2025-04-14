import React, { StrictMode } from "react";
import App from "./app";
import { createRoot } from "react-dom/client";


document.addEventListener("DOMContentLoaded", () => {// Recupera los cócteles inyectados en la variable global
const initialCocktails = window.initialCocktails || [];
    const container = document.getElementById("root");
    if (container) {
        const root = createRoot(container);
        root.render(
            <StrictMode>
                <App cocktails={initialCocktails} />
            </StrictMode>
        );
    } else {
        console.error("Root container not found");
    }
});
