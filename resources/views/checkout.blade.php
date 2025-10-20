@extends('layout')

@section('content')
<section id="checkout-page" style="max-width:1000px; margin:40px auto; color:#fff;">

  <h2 style="color:gold; text-align:center;">🎬 Checkout</h2>
  <p style="text-align:center; margin-bottom:30px;">Review your booking and add snacks if you like!</p>

  <div style="display:flex; gap:30px; flex-wrap:wrap;">

    <!-- LEFT: Booking Details -->
    <div style="flex:1; min-width:300px; background:#111; padding:20px; border-radius:10px;">
      <h3 style="color:gold;">Booking Summary</h3>
      <p><strong>Movie:</strong> {{ request('movie') ?? 'N/A' }}</p>
      <p><strong>Seats:</strong> {{ request('seats') ?? 1 }}</p>
      <p><strong>Day:</strong> {{ request('day') ?? 'Not Selected' }}</p>
      <p><strong>Time:</strong> {{ request('time') ?? 'Not Selected' }}</p>
      <hr>
      <p><strong>Ticket Price:</strong> Rs <span id="ticket-price">{{ request('total') ?? 500 }}</span></p>

      <div id="snack-summary"></div>

      <hr>
      <p style="font-size:18px;"><strong>Total Amount:</strong> Rs <span id="grand-total">{{ request('total') ?? 500 }}</span></p>
      <button id="confirm-btn" style="background:gold; color:#000; padding:10px 20px; border:none; border-radius:6px; cursor:pointer; width:100%;">Confirm Booking</button>
    </div>

    <!-- RIGHT: Add Snacks -->
    <div style="flex:1; min-width:300px; background:#111; padding:20px; border-radius:10px;">
      <h3 style="color:gold;">🍿 Add Snacks</h3>
      <p style="margin-bottom:15px;">Select optional snacks to enjoy during your movie.</p>

      <div id="snack-options" style="display:flex; flex-direction:column; gap:10px;">
        <label><input type="checkbox" class="snack" data-name="Popcorn" data-price="200"> Popcorn (Rs 200)</label>
        <label><input type="checkbox" class="snack" data-name="Cold Drink" data-price="150"> Cold Drink (Rs 150)</label>
        <label><input type="checkbox" class="snack" data-name="Chips" data-price="120"> Chips (Rs 120)</label>
        <label><input type="checkbox" class="snack" data-name="Juice" data-price="180"> Juice (Rs 180)</label>
      </div>
    </div>

  </div>
</section>

<!-- SweetAlert2 for confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const snackBoxes = document.querySelectorAll('.snack');
  const totalDisplay = document.getElementById('grand-total');
  const ticketPrice = parseInt(document.getElementById('ticket-price').textContent);
  const snackSummary = document.getElementById('snack-summary');
  let total = ticketPrice;

  // Update total dynamically when snacks are selected
  snackBoxes.forEach(cb => {
    cb.addEventListener('change', () => {
      let snackTotal = 0;
      let selectedSnacks = [];

      snackBoxes.forEach(box => {
        if (box.checked) {
          snackTotal += parseInt(box.dataset.price);
          selectedSnacks.push(`${box.dataset.name} (Rs ${box.dataset.price})`);
        }
      });

      totalDisplay.textContent = ticketPrice + snackTotal;
      snackSummary.innerHTML = selectedSnacks.length
        ? `<strong>Snacks:</strong><br>${selectedSnacks.join('<br>')}`
        : '';
    });
  });

  // Confirm Booking Button
  document.getElementById('confirm-btn').addEventListener('click', () => {
    const selectedSnacks = Array.from(snackBoxes)
      .filter(cb => cb.checked)
      .map(cb => cb.dataset.name)
      .join(', ') || 'None';

    const grandTotal = totalDisplay.textContent;

    Swal.fire({
      title: 'Booking Confirmed 🎉',
      html: `
        <b>Movie:</b> {{ request('movie') ?? 'N/A' }}<br>
        <b>Seats:</b> {{ request('seats') ?? 1 }}<br>
        <b>Snacks:</b> ${selectedSnacks}<br>
        <b>Total Paid:</b> Rs ${grandTotal}
      `,
      icon: 'success',
      background: '#111',
      color: '#fff',
      confirmButtonColor: 'gold'
    });
  });
</script>
@endsection
