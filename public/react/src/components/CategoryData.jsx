import styled from "styled-components";
import { AiOutlineEdit } from "react-icons/ai";
import { AiFillDelete } from "react-icons/ai";
import { useState } from "react";
import axios from "axios";

const CategoryData = (props ) => {
  

  const deleteCategory = (catId) => {
      debugger;
    axios.get(`http://127.0.0.1:8000/api/category/delete/${catId}`).then(res => {
       if(res.status==200){
             props.getCategories();
       }
      });
     
  };
  return (
    <>
      {props.data?.map(cat => (
        <CatData>
          <div className="content">
            <h3>{cat.name}</h3>
            <p>{cat.description}</p>
          </div>
          <div className="action">
            <AiOutlineEdit fontSize="25px" color="blue" />
            <AiFillDelete
              onClick={() => deleteCategory(cat.id)}
              fontSize="25px"
              color="red"
            />
          </div>
        </CatData>
      ))}
    </>
  );
};

export default CategoryData;

const CatData = styled.div`
  display: flex;
  flex-direction: column;
  background: black;
  color: white;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  align-item: center;
  border: 1px solid rgba(0, 0, 0, 1);
  margin: 0 auto;
  padding: 10px 10px;
  width: 300px;

  .content {
    text-align: center;
  }
  .action {
    display: flex;
    flex-direction: row;
    justify-content: end;
    align-item: center;
    gap: 10px;
  }
`;
