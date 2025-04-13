import React, { StrictMode } from "react";
import App from "./app";
import ReactDOM from "react-dom";
import "../css/app.css";
import './bootstrap';
import './components/Example';

// Recupera los cócteles inyectados en la variable global
const initialCocktails = window.initialCocktails || [];

ReactDOM.render(
    <StrictMode>
        <App cocktails={initialCocktails}/>
    </StrictMode>,
    document.getElementById("react-root")
);
