<script type="module">
    import {createClient} from 'https://unpkg.com/@supabase/supabase-js@2';
    const SUPABASE_URL = 'https://swmdkpythjvvbynkqepi.supabase.co';
    const SUPABASE_ANON_KEY = 'YOUR_ANON_KEY';
    const supabase = createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

    document.getElementById("feedbackForm").addEventListener("submit", async function (event) {
        event.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;

    const {data, error} = await supabase
    .from('Feedback')
    .insert([
    {name: name, email: email, text: message }
    ]);

    if (error) {
        console.error("Error sending data:", error);
    alert("Произошла ошибка при отправке данных. Попробуйте снова.");
        } else {
        alert("Спасибо за ваше сообщение!");
    document.getElementById("feedbackForm").reset();
    document.getElementById("feedbackModal").style.display = "none";
        }
    });
</script>
