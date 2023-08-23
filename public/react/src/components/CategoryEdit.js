// import axios from "axios";
// import React, { useState } from "react";
// import {LiaEdit} from 'react-icons/lia';

// const CategoryEdit = ({id,getCategories,data}) => {

//     const [name, setName] = useState(data.name);
//   const [description, setDescription] = useState(data.description);
//   const [responseMessage, setResponseMessage] = useState('');
//   const [editingCategory, setEditingCategory] = useState(null);
//   const [showModal, setShowModal] = useState(false);


//   const handleEditForm = async (e) => {
//     e.preventDefault();

//     try {
//     //   if (editingCategory) {
//         // Edit existing category
//         const response = await axios.post(`http://127.0.0.1:8000/api/category/update`, {
//           name: name,
//           description: description,
//           id:id,
//         });
//         setResponseMessage(response.data.message);

//         // Refresh categories
//         if (response.status === 200) {
//           getCategories();
//           setShowModal(false); // Hide the modal


//         }
//     //   } else {
//     //     // Add new category
//     //     const response = await axios.post('http://127.0.0.1:8000/api/category/store', {
//     //       name: name,
//     //       description: description,
//     //     });
//     //     setResponseMessage(response.data.message);

//     //     // Refresh categories
//     //     if (response.status === 200) {
//     //       props.getCategories();
//     //     }
//     //  }
      
//       // Clear form fields
//     //   setName('');
//     //   setDescription('');
//     //   setEditingCategory(null);
//     } catch (error) {
//       console.error('Error sending data:', error);
//     }
//   };

// //   const handleEdit = (category) => {
// //     setName(category.name);
// //     setDescription(category.description);
// //     setEditingCategory(category);
// //   };
//   return (
//     <>
//      <LiaEdit   className='text-primary fs-4' data-bs-toggle="modal" data-bs-target={`#EditCategory${id}`} onClick={()=>setShowModal(true)}  />

//      <div  className={`modal fade ${showModal ? 'show' : ''}`}  id={`EditCategory${id}`} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden={!showModal}>
//           <div className="modal-dialog">
//             <div className="modal-content">
//               <div className="modal-header">
//                 <h5 className="modal-title" id="exampleModalLabel">Category Add</h5>
//                 <button type="button" className="btn btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close">X</button>
//               </div>
//               <div className={`modal-body ${showModal ? 'modal-open' : ''}`}>
//                 <form onSubmit={handleEditForm} >
//                   <div className='fluid-container'>
                    

//                     <div className='row'>
//                       <div className='col-md-12 col-sm-12'>
//                         <label htmlFor='name' className='form-label'>Name</label> <br />
//                         <input type="text" name='name' className='form-control' 
//                          value={name}
//                          onChange={(e) => setName(e.target.value)}
//                          />
//                       </div>
//                       <div className='col-md-12 col-sm-12'>
//                         <label htmlFor='description' className='form-label'>Description</label> <br />
//                         <input type="text" name='description' className='form-control' 
//                            value={description}
//                            onChange={(e) => setDescription(e.target.value)}
//                         />
//                       </div>
//                       <div className='col-md-12 col-sm-12 mt-4'>
//                       <button type="submit" className='btn btn-primary float-end btn-sm'>Update</button>
//                       </div>
//                     </div>
//                   </div>
//                 </form>
//                 {responseMessage && <p>Response: {responseMessage}</p>}
//               </div>

//             </div>
//           </div>
//         </div>
//     </>
//   )
// }

// export default CategoryEdit
// import axios from "axios";
// import React, {  useState } from "react";
// import { LiaEdit } from 'react-icons/lia';

// const CategoryEdit = ({ id, getCategories, data }) => {

//   const [name, setName] = useState(data.name);
//   const [description, setDescription] = useState(data.description);
//   const [responseMessage, setResponseMessage] = useState('');
//   const [showModal, setShowModal] = useState(false);

//   const toggleModal = () => {
//     setShowModal(!showModal);
//     if (!showModal) {
//       document.body.classList.add('modal-open');
//     } else {
//       document.body.classList.remove('modal-open');
//     }
//   };

//   const handleEditForm = async (e) => {
//     e.preventDefault();

//     try {
//       const response = await axios.post(`http://127.0.0.1:8000/api/category/update`, {
//         name: name,
//         description: description,
//         id: id,
//       });
//       setResponseMessage(response.data.message);

//       // Refresh categories
//       if (response.status === 200) {
//         getCategories();
//         setShowModal(false); // Hide the modal
//       }
//     } catch (error) {
//       console.error('Error sending data:', error);
//     }
//   };

//   return (
//     <>
//       <LiaEdit className='text-primary fs-4' data-bs-toggle="modal" data-bs-target={`#EditCategory${id}`} onClick={() => setShowModal(true)} />

//       <div className={`modal fade ${showModal ? 'show' : ''}`} id={`EditCategory${id}`} tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden={!showModal}>
//         <div className="modal-dialog">
//           <div className="modal-content">
//             <div className="modal-header">
//               <h5 className="modal-title" id="exampleModalLabel">Category Add</h5>
//               <button type="button" className="btn btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close" onClick={() => setShowModal(false)}>X</button>
//             </div>
//             <div className={`modal-body ${showModal ? 'modal-open' : ''}`}>
//               <form onSubmit={handleEditForm}>
//                 <div className='fluid-container'>
//                   <div className='row'>
//                     <div className='col-md-12 col-sm-12'>
//                       <label htmlFor='name' className='form-label'>Name</label> <br />
//                       <input type="text" name='name' className='form-control'
//                         value={name}
//                         onChange={(e) => setName(e.target.value)}
//                       />
//                     </div>
//                     <div className='col-md-12 col-sm-12'>
//                       <label htmlFor='description' className='form-label'>Description</label> <br />
//                       <input type="text" name='description' className='form-control'
//                         value={description}
//                         onChange={(e) => setDescription(e.target.value)}
//                       />
//                     </div>
//                     <div className='col-md-12 col-sm-12 mt-4'>
//                       <button type="submit" className='btn btn-primary float-end btn-sm'>Update</button>
//                     </div>
//                   </div>
//                 </div>
//               </form>
//               {responseMessage && <p>Response: {responseMessage}</p>}
//             </div>
//           </div>
//         </div>
//       </div>
//     </>
//   )
// }

// export default CategoryEdit;
import axios from "axios";
import React, { useState } from "react";
import { LiaEdit } from 'react-icons/lia';

const CategoryEdit = ({ id, getCategories, data }) => {
  const [name, setName] = useState(data.name);
  const [description, setDescription] = useState(data.description);
  const [responseMessage, setResponseMessage] = useState('');
  const [showModal, setShowModal] = useState(false);

  const toggleModal = () => {
    setShowModal(!showModal);
    if (!showModal) {
      document.body.classList.add('modal-open');
    } else {
      document.body.classList.remove('modal-open');
    }
  };

  const handleEditForm = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(`http://127.0.0.1:8000/api/category/update`, {
        name: name,
        description: description,
        id: id,
      });
      setResponseMessage(response.data.message);

      // Refresh categories
      if (response.status === 200) {
        setShowModal
        getCategories();
        toggleModal(); // Hide the modal
      }
    } catch (error) {
      console.error('Error sending data:', error);
    }
  };

  return (
    <>
      <LiaEdit className='text-primary fs-4' data-bs-toggle="modal" data-bs-target={`#EditCategory${id}`} onClick={toggleModal} />

      <div className={`modal fade ${showModal ? 'show' : ''}`} id={`EditCategory${id}`} tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden={!showModal}>
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="exampleModalLabel">Category Add</h5>
              <button type="button" className="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close" onClick={toggleModal}>X</button>
            </div>
            <div className={`modal-body ${showModal ? 'modal-open' : ''}`}>
            <form onSubmit={handleEditForm}>
                 <div className='fluid-container'>
                   <div className='row'>
                     <div className='col-md-12 col-sm-12'>
                       <label htmlFor='name' className='form-label'>Name</label> <br />
                       <input type="text" name='name' className='form-control'
                         value={name}
                         onChange={(e) => setName(e.target.value)}
                       />
                     </div>
                     <div className='col-md-12 col-sm-12'>
                       <label htmlFor='description' className='form-label'>Description</label> <br />
                       <input type="text" name='description' className='form-control'
                         value={description}
                         onChange={(e) => setDescription(e.target.value)}
                       />
                     </div>
                     <div className='col-md-12 col-sm-12 mt-4'>
                       <button type="submit" className='btn btn-primary float-end btn-sm'>Update</button>
                     </div>
                   </div>
                 </div>
               </form>
              {responseMessage && <p>Response: {responseMessage}</p>}
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default CategoryEdit;






