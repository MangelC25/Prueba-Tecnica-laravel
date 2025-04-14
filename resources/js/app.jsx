import React, { useState, useEffect } from "react";
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/react";
import { ChevronDownIcon } from "@heroicons/react/20/solid";
import clsx from "clsx";
import "datatables.net";

const App = ({ cocktails = [] }) => {
    const handleVerMas = (cocktail) => {
        console.log("Ver más sobre:", cocktail);
    };

    // Estado para almacenar la lista de categorías
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setselectedCategory] = useState("All Categories");

    // Función para obtener las categorías desde la API
    useEffect(() => {
        async function fetchCategories() {
            try {
                const response = await fetch(
                    "https://www.thecocktaildb.com/api/json/v1/1/list.php?c=list"
                );
                const data = await response.json();
                if (data && data.drinks) {
                    // Extraemos el valor de 'strCategory' de cada objeto y actualizamos el estado
                    const cats = data.drinks.map((item) => item.strCategory);
                    setCategories(cats);
                }
            } catch (error) {
                console.error("Error al obtener las categorías:", error);
            }
        }
        fetchCategories();
    }, []);

    const handleSearch = () => {
        // Lógica de búsqueda
        console.log("Buscando cócteles...");
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white">
            <section className="py-16 px-6 text-center flex flex-col justify-center items-center">
                <h2 className="text-4xl sm:text-5xl md:text-6xl font-extrabold text-transparent  bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-600 mb-6">
                    Explore the Future of Cocktails
                </h2>
                <p className="text-gray-400 max-w-3xl mx-auto mb-10 text-lg sm:text-xl">
                    Immerse yourself in a futuristic collection of cocktail
                    recipes, crafted for the modern connoisseur.
                </p>
                <div className="flex flex-col sm:flex-row items-center justify-center max-w-2xl mx-auto gap-6">
                    <input
                        type="text"
                        placeholder="Search cocktails by name..."
                        className="bg-gray-800 text-gray-300 flex-1 px-5 py-3 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition duration-300"
                    />
                    <button
                        onClick={handleSearch}
                        className="cursor-pointer bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-purple-600 hover:to-cyan-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        Search
                    </button>
                    <div className="relative">
                        <Listbox
                            value={selectedCategory}
                            onChange={setselectedCategory}
                        >
                            <ListboxButton
                                className={clsx(
                                    "relative w-50 rounded-lg bg-gray-800 text-gray-300 flex gap-6 px-5 py-3 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition duration-300",
                                    "focus:outline-none data-[focus]:outline-2 data-[focus]:-outline-offset-2 data-[focus]:outline-white/25"
                                )}
                            >
                                {selectedCategory}
                                <ChevronDownIcon
                                    className="group pointer-events-none size-4 fill-white/60 flex absolute right-3 top-1/2 -translate-y-1/2 transition duration-200 ease-in-out"
                                    aria-hidden="true"
                                />
                            </ListboxButton>
                            <ListboxOptions
                                anchor="bottom"
                                transition
                                className={clsx(
                                    "w-[var(--button-width)] h-50 rounded-xl border border-white/5 bg-black/50 p-1 [--anchor-gap:var(--spacing-1)] focus:outline-none",
                                    "transition duration-100 ease-in data-[leave]:data-[closed]:opacity-0",
                                    "overflow-y-auto max-h-60 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full  [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-sky-500/70"
                                )}
                            >
                                <ListboxOption
                                    value={selectedCategory}
                                    className="group flex cursor-default items-center gap-2 rounded-lg py-1.5 px-3 select-none data-[focus]:bg-white/10 text-white"
                                >
                                    {selectedCategory}
                                </ListboxOption>
                                {categories.map((cat, idx) => (
                                    <ListboxOption
                                        key={idx}
                                        value={cat}
                                        className="group flex cursor-default items-center gap-2 rounded-lg py-1.5 px-3 select-none data-[focus]:bg-white/10 text-white"
                                    >
                                        {cat}
                                    </ListboxOption>
                                ))}
                            </ListboxOptions>
                        </Listbox>
                    </div>
                </div>
            </section>

            <div className="max-w-7xl mx-auto p-8">
                <h1 className="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-600 mb-12 text-center">
                    🍹 Cocktail Collection
                </h1>

                <div className="grid gap-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    {cocktails.map((c, index) => (
                        <div
                            key={index}
                            className="bg-gradient-to-br from-gray-800 via-gray-900 to-black rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500"
                        >
                            <img
                                className="w-full h-64 object-cover filter brightness-75 hover:brightness-100 transition duration-300"
                                src={
                                    c.strDrinkThumb ||
                                    "https://via.placeholder.com/400x300?text=No+Image"
                                }
                                alt={c.strDrink}
                            />
                            <div className="p-6">
                                <h2 className="text-3xl font-extrabold text-white mb-4">
                                    {c.strDrink}
                                </h2>
                                <p className="text-gray-400 mb-3">
                                    <span className="font-semibold text-gray-300">
                                        Category:
                                    </span>{" "}
                                    {c.strCategory}
                                </p>
                                <p className="text-gray-400 mb-6">
                                    <span className="font-semibold text-gray-300">
                                        Glass:
                                    </span>{" "}
                                    {c.strGlass}
                                </p>
                                <button
                                    onClick={() => handleVerMas(c)}
                                    className="w-full bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-purple-600 hover:to-cyan-500 text-white font-bold py-3 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                                >
                                    Learn More
                                </button>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default App;
