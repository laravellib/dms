<div class="mb-4">
    <select name="method" id="method">
        <option value="bank-transfer">Bank transfer</option>
        <option value="revolut">Revolut</option>
        <option value="paypal">Paypal</option>
        <option value="paypal">Cash</option>
    </select>
</div>


<div class="w-full md:w-1/6 mb-4">
    <input type="number" name="amount" id="amount" value="{{ old('value') }}" placeholder="Amount"
        class="w-full border rounded-lg px-3 py-2 bg-gray-200 border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500">
</div>

<div class="mb-4">
    <select name="currency" id="currency">
        <option value="eur" selected>CHF</option>
        <option value="eur">Euro</option>
    </select>
</div>

<div class="w-full md:w-1/6 mb-4">
    <input type="text" name="code" id="code" value="{{ old('value') }}" placeholder="Code"
        class="w-full border rounded-lg px-3 py-2 bg-gray-200 border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500">
</div>

<div class="w-full md:w-1/6 mb-4">
    <input type="text" name="provider" id="provider" value="{{ old('value') }}" placeholder="Provider"
        class="w-full border rounded-lg px-3 py-2 bg-gray-200 border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500">
</div>

<div class="w-full mb-4">
    <textarea name="comments" id="comments" cols="30" rows="5"
        class="w-full border rounded-lg px-3 py-2 bg-gray-200 border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500">{{ old('value') }}</textarea>
</div>