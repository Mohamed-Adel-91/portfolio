import React, { useEffect, useState } from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import { HashLoader } from "react-spinners";
import Home from "./Home";
import "./App.css";

const App = () => {
    const [loading, setLoading] = useState(false);
    useEffect(() => {
        setLoading(true);
        setTimeout(() => {
            setLoading(false);
        }, 3000);
    }, []);
    return (
        <BrowserRouter>
            {loading ? (
                <div className="preLoader">
                    <HashLoader
                        color="#3d4abe"
                        loading={loading}
                        height={100}
                        margin={10}
                    />
                </div>
            ) : (
                <>
                    <Routes>
                        <Route path="/" element={<Home />} />
                    </Routes>
                </>
            )}
        </BrowserRouter>
    );
};

export default App;
