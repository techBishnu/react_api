import React, { useEffect, useState } from 'react';
import Header from "./components/header";
import About from "./pages/About";
import Contact from "./pages/Contact";
import Home from "./pages/Home";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import { BsSearch } from 'react-icons/bs';
import { AiFillPlusCircle } from 'react-icons/ai';
import axios from 'axios';
import CategoryDataShow from './components/CategoryDataShow';
import CategoryStore from './components/CategoryStore';

function App() {
  const [data, setData] = useState(null)
  const getCategories = () => {

    axios.get('http://127.0.0.1:8000/api/category').then(res => {
      console.log(res);
      setData(res.data.categories)
    })
  };

  useEffect(() => {
    
    getCategories()
  }, []);

  return (
    <>

      {/* < Header /> */
      /* <Routes>
        <Route path="/" element={< Home />} />
        <Route path="about" element={ <About/>} />
        <Route path="contact" element={ < Contact />} />
      </Routes> */}
      <div className='fluid-containe'>
        <div className="row justify-content-evenly ">

          <div className="bg-dark text-white d-flex justify-content-center align-items-center w-75  mt-2">
            <h3>FireBase Contact App</h3>
          </div>
        </div>
        <div className="row justify-content-end align-items-center  ">
          <div className="w-50 position-relative mt-4 justify-content-end ">
            <span className='position-absolute px-2 text-center pt-1'> <BsSearch fontSize="20px" /></span> <input type="search" className='px-5  w-50 py-1' />
            <span > <AiFillPlusCircle fontSize="35px" className='text-warning ' data-bs-toggle="modal" data-bs-target="#exampleModal" /></span>
          </div>
        </div>
          <CategoryStore  getCategory={getCategories}/>
        <div className='row justify-content-around m-3'>
         
          <CategoryDataShow  data={data} getCategory={getCategories} />
          
          {/* <div className='col-md-4 col-sm-3 w-25 border border-primary'>
            <h1>test</h1>
            <p>desvf</p>
          </div>
          <div className='col-md-4 col-sm-3 w-25 border border-primary'>
            <h1>test</h1>
            <p>desvf</p>
          </div> */}
        </div>
      </div>

    </>
  );
}

export default App;
