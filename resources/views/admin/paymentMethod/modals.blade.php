<!-- Cryptocurrency Modal -->
<div class="modal fade" id="cryptoModal" tabindex="-1" role="dialog" aria-labelledby="cryptoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cryptoModalLabel">Add Cryptocurrency Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment_methods.store_crypto') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cryptoName">Cryptocurrency Name</label>
                        <input type="text" name="name" class="form-control" id="cryptoName" required placeholder="Enter Cryptocurrency Name">
                    </div>
                    <div class="form-group">
                        <label for="cryptoWallet">Wallet Address</label>
                        <input type="text" name="wallet" class="form-control" id="cryptoWallet" required placeholder="Enter Wallet Address">
                    </div>
                    <div class="form-group">
                        <label for="cryptoNetwork">Network</label>
                        <input type="text" name="network" class="form-control" id="cryptoNetwork" required placeholder="Enter Network (e.g. ERC20, BEP20)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Cryptocurrency</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Gift Card Modal -->
<div class="modal fade" id="giftCardModal" tabindex="-1" role="dialog" aria-labelledby="giftCardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="giftCardModalLabel">Add Gift Card Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment_methods.store_giftcard') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="giftCardMerchant">Gift Card Merchant</label>
                        <input type="text" name="merchant" class="form-control" id="giftCardMerchant" required placeholder="Enter Merchant Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Gift Card</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bank Transfer Modal -->
<div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankModalLabel">Add Bank Transfer Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.payment_methods.store_bank') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bankMethod">Method Name</label>
                        <input type="text" name="method" class="form-control" id="bankMethod" required placeholder="e.g. Bank Transfer, PayPal">
                    </div>
                    <div class="form-group">
                        <label for="bankName">Bank Name</label>
                        <input type="text" name="name" class="form-control" id="bankName" required placeholder="Enter Bank Name">
                    </div>
                    <div class="form-group">
                        <label for="bankDetail">Bank Details</label>
                        <textarea name="detail" class="form-control" id="bankDetail" rows="3" required placeholder="Enter bank details"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Bank</button>
                </div>
            </form>
        </div>
    </div>
</div>
