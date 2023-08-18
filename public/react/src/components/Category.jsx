import { useState, useEffect } from "react";
import axios from "axios";
import styled from "styled-components";
import CategoryData from "./CategoryData";

const Category = () => {
  const [data, setData] = useState(null);
  const categories = () => {
    axios.get("http://127.0.0.1:8000/api/category").then(res => {
      // console.log(res.data.categories)
      setData(res.data.categories);
    });
  };

  useEffect(() => {
    categories();
  }, []);

  return (
    <CategoryDiv>
      <CategoryData data={data} getCategories={()=>categories()} />
    </CategoryDiv>
  );
};
export default Category;

const CategoryDiv = styled.section`
  background: rgba(255, 255, 255, 0.2);
  border-radius: 16px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-item: center;
  margin: 20px 0;
  min-height:90vh;


  gap:10px;
`;
