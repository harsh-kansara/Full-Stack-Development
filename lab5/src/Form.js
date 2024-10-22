// src/Form.js
import React, { useState } from 'react';
import './Form.css';

const Form = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    age: '',
    phone: '',  // New field for phone number
  });

  const [errors, setErrors] = useState({});
  const [success, setSuccess] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const validateEmail = (email) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  };

  const validatePhone = (phone) => {
    const phoneRegex = /^[0-9]{10}$/;  // Simple phone number validation (10 digits)
    return phoneRegex.test(phone);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    let validationErrors = {};

    // Check if the fields are empty or invalid
    if (!formData.name) validationErrors.name = 'Name is required';
    if (!formData.email) {
      validationErrors.email = 'Email is required';
    } else if (!validateEmail(formData.email)) {
      validationErrors.email = 'Invalid email format';
    }
    if (!formData.age) validationErrors.age = 'Age is required';
    if (!formData.phone) {
      validationErrors.phone = 'Phone number is required';
    } else if (!validatePhone(formData.phone)) {
      validationErrors.phone = 'Phone number must be 10 digits';
    }

    // If no errors, show success message
    if (Object.keys(validationErrors).length === 0) {
      setSuccess('Form submitted successfully!');
      setErrors({});
      setFormData({
        name: '',
        email: '',
        age: '',
        phone: '',
      });
    } else {
      setErrors(validationErrors);
      setSuccess('');
    }
  };

  return (
    <div className="form-container">
      <form onSubmit={handleSubmit}>
        <h2>Personal Data Form</h2>

        <div className="form-group">
          <label>Name</label>
          <input
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            className={errors.name ? 'error' : ''}
          />
          {errors.name && <span className="error-message">{errors.name}</span>}
        </div>

        <div className="form-group">
          <label>Email</label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            className={errors.email ? 'error' : ''}
          />
          {errors.email && <span className="error-message">{errors.email}</span>}
        </div>

        <div className="form-group">
          <label>Age</label>
          <input
            type="number"
            name="age"
            value={formData.age}
            onChange={handleChange}
            className={errors.age ? 'error' : ''}
          />
          {errors.age && <span className="error-message">{errors.age}</span>}
        </div>

        <div className="form-group">
          <label>Phone Number</label>
          <input
            type="text"
            name="phone"
            value={formData.phone}
            onChange={handleChange}
            className={errors.phone ? 'error' : ''}
          />
          {errors.phone && <span className="error-message">{errors.phone}</span>}
        </div>

        <button type="submit">SUBMIT</button>
      </form>

      {success && <div className="success-message">{success}</div>}
    </div>
  );
};

export default Form;
