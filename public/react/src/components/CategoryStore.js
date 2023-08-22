import axios from 'axios';
import React, { useState } from 'react'
import Swal from 'sweetalert2';

const CategoryStore = (props) => {
      // for store
  const [name, setName] = useState('');
  const [description, setDescription] = useState('');
  const [responseMessage, setResponseMessage] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/category/store', {
        name: name,
        description: description,
      });

      setResponseMessage(response.data.message); 
      if (response.status === 200) {
        props.getCategory();
       window.location.reload()
        Swal.fire({
        title: 'Success...',
        text: 'Successfully added Category',
        icon: 'success',
      });
      }
    } catch (error) {
      console.error('Error sending data:', error);
    }
  };
  return (
        <div className="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <h5 className="modal-title" id="exampleModalLabel">Category Add</h5>
                <button type="button" className="btn btn-danger  btn-sm" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div className="modal-body">
                <form onSubmit={handleSubmit}>
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
                      <button type="submit" className='btn btn-primary float-end btn-sm'>Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
                {responseMessage && <p>Response: {responseMessage}</p>}
              </div>

            </div>
          </div>
        </div>
  )
}

export default CategoryStore