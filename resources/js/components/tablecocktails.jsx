import React, { useState, useEffect } from "react";

const TableCocktails = ({ cocktails: initialCocktails = [] }) => {
    // Estado de la lista de cócteles y búsqueda
    const [cocktails, setCocktails] = useState(initialCocktails);
    const [searchQuery, setSearchQuery] = useState("");

    // Estado para la paginación
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 6;

    // Si no se pasan cócteles por props, se hace fetch a la API
    useEffect(() => {
        if (initialCocktails.length === 0) {
            fetch("https://www.thecocktaildb.com/api/json/v1/1/search.php?f=a")
                .then((response) => response.json())
                .then((data) => {
                    if (data && data.drinks) {
                        setCocktails(data.drinks);
                    } else {
                        setCocktails([]);
                    }
                })
                .catch((error) =>
                    console.error("Error fetching cocktails:", error)
                );
        }
    }, [initialCocktails]);

    // Filtrar cócteles por búsqueda (local)
    const filteredCocktails = cocktails.filter((cocktail) =>
        cocktail.strDrink.toLowerCase().includes(searchQuery.toLowerCase())
    );

    // Paginación: calcular total de páginas y cócteles a mostrar
    const totalPages = Math.ceil(filteredCocktails.length / itemsPerPage);
    const displayedCocktails = filteredCocktails.slice(
        (currentPage - 1) * itemsPerPage,
        currentPage * itemsPerPage
    );

    // Reinicia la paginación cada vez que cambia la búsqueda
    useEffect(() => {
        setCurrentPage(1);
    }, [searchQuery]);

    const handleInputChange = (e) => {
        setSearchQuery(e.target.value);
    };

    const handlePrevPage = () => {
        setCurrentPage((prev) => Math.max(prev - 1, 1));
    };

    const handleNextPage = () => {
        setCurrentPage((prev) => Math.min(prev + 1, totalPages));
    };


    const handleGuardar = (cocktail) => {
      console.log("Enviando cóctel:", cocktail);
      fetch("/cocktails", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document
                  .querySelector('meta[name="csrf-token"]')
                  .getAttribute("content"),
              "X-Requested-With": "XMLHttpRequest",
          },
          credentials: "include", // Asegúrate de enviar la cookie de sesión
          body: JSON.stringify(cocktail),
      })
          .then((response) => {
              if (!response.ok) {
                  throw new Error("Error al guardar el cóctel");
              }
              return response.json();
          })
          .then((data) => {
              console.log("Cóctel guardado:", data);
              // Aquí podrías actualizar el estado o notificar al usuario
          })
          .catch((error) => console.error("Error:", error));
      console.log("Esperando respuesta...");
  };

    return (
        <div className="min-h-200 pt-25 pb-35 bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white p-6">
            <h1 className="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-blue-500 mb-8 text-center">
                🍹 Lista de Cócteles
            </h1>

            {/* Barra de búsqueda */}
            <div className="flex flex-col md:flex-row items-center justify-between mb-4 gap-4">
                <input
                    type="text"
                    placeholder="Buscar cócteles por nombre..."
                    value={searchQuery}
                    onChange={handleInputChange}
                    className="w-full md:w-1/3 bg-gray-800 text-gray-300 px-4 py-2 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition duration-300"
                />
                <button
                    onClick={() => handleGuardar(cocktails[0])}
                    className="cursor-pointer bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-purple-600 hover:to-cyan-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                >
                    Agregar
                </button>
            </div>

            <div className="overflow-x-auto">
                <table className="min-w-full w-full table-fixed bg-gray-800 rounded-lg border border-gray-700">
                    <thead className="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600">
                        <tr>
                            <th className="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                Nombre
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                Categoría
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                Vasos
                            </th>
                            {/* Ocultamos la columna de instrucciones en pantallas muy pequeñas */}
                            <th className="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider hidden md:table-cell">
                                Instrucciones
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {displayedCocktails.length > 0 ? (
                            displayedCocktails.map((cocktail, index) => (
                                <tr
                                    key={index}
                                    className="odd:bg-gray-700 hover:bg-gray-600 transition-colors"
                                >
                                    <td className="px-4 py-2 text-sm font-medium break-words">
                                        {cocktail.strDrink}
                                    </td>
                                    <td className="px-4 py-2 text-sm break-words">
                                        {cocktail.strCategory}
                                    </td>
                                    <td className="px-4 py-2 text-sm break-words">
                                        {cocktail.strGlass}
                                    </td>
                                    <td className="px-4 py-2 text-sm break-words hidden md:table-cell">
                                        {cocktail.strInstructions}
                                    </td>
                                    <td className="px-4 py-2 text-sm">
                                        {/* Botones de acción, manteniendo que el contenido se ajuste */}
                                        <button
                                            onClick={() =>
                                                console.log("Editar:", cocktail)
                                            }
                                            className="bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white font-bold px-3 py-2 rounded-lg shadow-lg transition-transform transform hover:scale-105 inline-flex items-center"
                                        >
                                            {/* Ícono opcional */}
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                className="h-5 w-5 mr-1"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                    strokeWidth={2}
                                                    d="M11 17l-4 4m0 0l-4-4m4 4V3"
                                                />
                                            </svg>
                                            Editar
                                        </button>
                                        <button
                                            onClick={() =>
                                                console.log(
                                                    "Eliminar:",
                                                    cocktail
                                                )
                                            }
                                            className="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-bold px-3 py-2 rounded-lg shadow-lg transition-transform transform hover:scale-105 inline-flex items-center ml-2"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                className="h-5 w-5 mr-1"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                strokeWidth="1.5"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td
                                    colSpan="5"
                                    className="px-4 py-2 text-center text-sm"
                                >
                                    No se encontraron cócteles
                                </td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>
            {totalPages > 1 && (
                <div className="flex justify-center items-center space-x-4 mt-6">
                    <button
                        onClick={handlePrevPage}
                        disabled={currentPage === 1}
                        className="bg-gray-700 hover:bg-gray-600 text-white font-bold px-4 py-2 rounded disabled:opacity-50 transition"
                    >
                        Prev
                    </button>
                    <span className="text-white">
                        Página {currentPage} de {totalPages}
                    </span>
                    <button
                        onClick={handleNextPage}
                        disabled={currentPage === totalPages}
                        className="bg-gray-700 hover:bg-gray-600 text-white font-bold px-4 py-2 rounded disabled:opacity-50 transition"
                    >
                        Next
                    </button>
                </div>
            )}
        </div>
    );
};

export default TableCocktails;
