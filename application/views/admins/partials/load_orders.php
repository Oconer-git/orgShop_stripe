
                <?php if($orders): ?>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td><span><a href="#"><?= $order['id']?></a></span></td>
                            <td><span><?= $order['created_at'] ?></span></td>
                            <td><span><?= $order['first_name']." ".$order['last_name'] ?><span><?= $order['address1'] ?></span></span></td>
                            <td><span>₱ <?= $order['total_amount'] ?></span></td>
    
                            <td> 
                                <form action="<?= base_url('Admins/update_status')?>" class="update_status_form" method="post">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <select name="status" class="select_status">
                                        <option><?= $order['status'] ?></option>
                                        <option>pending</option>
                                        <option>on-process</option>
                                        <option>shipped</option>
                                        <option>delivered</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>