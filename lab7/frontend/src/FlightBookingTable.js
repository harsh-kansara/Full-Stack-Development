import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './FlightBookingTable.css';

const FlightBookingTable = () => {
  const [bookings, setBookings] = useState([]);

  useEffect(() => {
    const fetchBookings = async () => {
      try {
        const response = await axios.get('http://localhost:5000/bookings');
        setBookings(response.data);
      } catch (error) {
        console.error(error);
      }
    };
    fetchBookings();
  }, []);

  return (
    <table>
      <thead>
        <tr>
          <th>Passenger Name</th>
          <th>From</th>
          <th>To</th>
          <th>Departure Date</th>
          <th>Arrival Date</th>
          <th>Phone Number</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        {bookings.map((booking) => (
          <tr key={booking.phoneNumber}>
            <td>{booking.passengerName}</td>
            <td>{booking.from}</td>
            <td>{booking.to}</td>
            <td>{booking.departureDate}</td>
            <td>{booking.arrivalDate}</td>
            <td>{booking.phoneNumber}</td>
            <td>{booking.email}</td>
          </tr>
        ))}
      </tbody>
    </table>
  );
};

export default FlightBookingTable;
