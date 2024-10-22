import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './FlightBookingForm.css';

const FlightBookingForm = () => {
  const [booking, setBooking] = useState({
    passengerName: '',
    from: '',
    to: '',
    departureDate: '',
    phoneNumber: '',
    email: ''
  });

  const navigate = useNavigate();

  const handleChange = (e) => {
    setBooking({ ...booking, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:5000/bookings', booking)
      .then(() => {
        navigate('/bookings');
      });
      alert('Booking inserted successfully');
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div className="form-container">
      <h2>Flight Booking Form</h2>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Passenger Name</label>
          <input
            type="text"
            name="passengerName"
            value={booking.passengerName}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label>From</label>
          <input
            type="text"
            name="from"
            value={booking.from}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label>To</label>
          <input
            type="text"
            name="to"
            value={booking.to}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label>Departure Date</label>
          <input
            type="date"
            name="departureDate"
            value={booking.departureDate}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label>Phone Number</label>
          <input
            type="tel"
            name="phoneNumber"
            value={booking.phoneNumber}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label>Email ID</label>
          <input
            type="email"
            name="email"
            value={booking.email}
            onChange={handleChange}
            required
          />
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  );
};

export default FlightBookingForm;
