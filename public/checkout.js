// This is your test publishable API key.


// The items the customer wants to buy
const items = [{ id: "xl-tshirt", amount: 1000 }];

let elements;

initialize();

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

async function initialize() {
  const { clientSecret } = await fetch("../public/create.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ items }),
  }).then((r) => r.json());

  elements = stripe.elements({ clientSecret });

  const paymentElementOptions = {
    layout: "accordion",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      return_url: "http://localhost/safenest_life_system/public/complete.html",
    },
  });

  if (error?.type === "card_error" || error?.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

function showMessage(messageText) {
  const messageContainer = document.querySelector("#payment-message");

  messageContainer.classList.remove("hidden");
  messageContainer.textContent = messageText;

  setTimeout(() => {
    messageContainer.classList.add("hidden");
    messageContainer.textContent = "";
  }, 4000);
}

function setLoading(isLoading) {
  const submitBtn = document.querySelector("#submit");
  const spinner = document.querySelector("#spinner");
  const buttonText = document.querySelector("#button-text");

  submitBtn.disabled = isLoading;
  spinner.classList.toggle("hidden", !isLoading);
  buttonText.classList.toggle("hidden", isLoading);
}
