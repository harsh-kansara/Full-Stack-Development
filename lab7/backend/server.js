const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();

// Middleware
app.use(cors());
app.use(express.json());

// MongoDB Connection
mongoose.connect('mongodb://localhost:27017/flightDB', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

// Mongoose Schema
const bookingSchema = new mongoose.Schema({
  passengerName: String,
  from: String,
  to: String,
  departureDate: String,
  arrivalDate: String,
  phoneNumber: String,
  email: String,
});

const Booking = mongoose.model('Booking', bookingSchema);

// Routes

// Insert new booking (Create)
app.post('/bookings', async (req, res) => {
  try {
    var booking = {...req.body};
    booking.arrivalDate = booking.departureDate;
    console.log(booking)

    const newBooking = new Booking(booking);
    await newBooking.save();
    res.status(201).send(newBooking);
  } catch (error) {
    res.status(400).send(error);
  }
});

// Update booking by phone number (Update)
app.put('/bookings/update/:phoneNumber', async (req, res) => {
  try {
    const updatedBooking = await Booking.findOneAndUpdate(
      { phoneNumber: req.params.phoneNumber },
      req.body,
      { new: true }
    );
    if (!updatedBooking) return res.status(404).send('Booking not found');
    res.send(updatedBooking);
  } catch (error) {
    res.status(400).send(error);
  }
});

// Delete booking by phone number (Delete)
app.delete('/bookings/delete/:phoneNumber', async (req, res) => {
  try {
    const deletedBooking = await Booking.findOneAndDelete({
      phoneNumber: req.params.phoneNumber,
    });
    if (!deletedBooking) return res.status(404).send('Booking not found');
    res.send(deletedBooking);
  } catch (error) {
    res.status(400).send(error);
  }
});

// Get all bookings (Read)
app.get('/bookings', async (req, res) => {
  try {
    const bookings = await Booking.find();
    res.send(bookings);
  } catch (error) {
    res.status(400).send(error);
  }
});

// Start the server
app.listen(5000, () => {
  console.log('Server is running on port 5000');
});
