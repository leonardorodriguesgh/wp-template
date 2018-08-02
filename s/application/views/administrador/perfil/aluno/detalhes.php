
	
	
	<div class="row">
		<div class="col-md-3 side">
			<div class="">
				<img src="<?php echo site_url('assets')?>/images/sistema/menu/aluno_foto_perfil.png" alt="">
			</div>
				
			<div class="aluno-detalhe-yellow col-md-12">
				<h4><img src="<?php echo site_url('assets')?>/images/sistema/menu/certificado_bw.png" alt=""> Cursos Concluidos</h4>
			</div>
			<div class="aluno-detalhe-blue col-md-12">
				<h4><img src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_bw.png" alt=""> Cursos em andamento</h4>
			</div>
			<div class="aluno-detalhe-green col-md-12">
				<h4><img src="<?php echo site_url('assets')?>/images/sistema/menu/desempenho_bw.png" alt=""> Análise de desempenho</h4>
			</div>
		</div>
		<div class="col-md-9 d-green text-left">
			<h1 class="border-bot"><?php echo $alunoUsuario[0]['nome']?></h1>
			
		</div>
			
		<div class="col-md-3 a-info d-green"><br>
			<strong>Telefone:</strong>
			<p><?php echo $alunoUsuario[0]['telefone']?></p>		
			<strong>Data de nascimento:</strong>
			<p><?php echo $alunoUsuario[0]['dt_nascimento']?></p>
			<strong>CEP:</strong>
			<p><?php echo $alunoUsuario[0]['telefone']?></p>			
		</div>
		<div class="col-md-2 a-info d-green"><br>
			<strong>Celular:</strong>
			<p><?php echo $alunoUsuario[0]['celular']?></p>
			<strong>Sexo:</strong>
			<p><?php echo $alunoUsuario[0]['cpf']?></p>
			<strong>Endereco:</strong>
			<p><?php echo $alunoUsuario[0]['nome']?></p>
				
		</div>
		<div class="col-md-2 a-info d-green"><br>
			<strong>Email:</strong>
			<p><?php echo $alunoUsuario[0]['email']?></p>
			<strong>CPF:</strong>
			<p><?php echo $alunoUsuario[0]['telefone']?></p>
			<strong>RG:</strong>
			<p><?php echo $alunoUsuario[0]['rg']?></p>
		
		</div>
		<div class="d-green">		
			<div class="col-md-9">
				<div class="border-bot">
					<div class="col-md-6 text-left" style="padding:0">
						<h1 class="n-margin ">
							Dados financeiros
						</h1>
					</div>
					<div class="col-md-6">						
						<div class="form">
							<?php
								//var_dump($alunoUsuario);
								echo form_open('Administrador/Aluno/ativarAluno/'.$alunoUsuario[0]['id_aluno']);
								?>
								<button type="submit" id="ativar" name="ativar" onclick="window.location'<?php echo site_url("Administrador/Aluno/ativarAluno/".$alunoUsuario[0]['id_aluno']);?>'" value="Ativar" style="background:transparent;border:0px; outline:none"/>
									<img src="<?php echo site_url('assets')?>/images/sistema/menu/liberar.png" alt="">
								</button>
								<button type="submit" id="desativar" name="desativar"  onclick="window.location'<?php echo site_url("Administrador/Aluno/ativarAluno/".$alunoUsuario[0]['id_aluno']);?>'" value="Desativar" style="background:transparent;border:0px; outline:none"/>
									<img src="<?php echo site_url('assets')?>/images/sistema/menu/bloquear.png" alt="">
								</button>
								
								<?php 
									echo form_close();
									//print_r($alunoUsuario);
							?>
							
						</div>
								
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-2">
					<strong>Status: </strong><br>
					<p id="getAtivo" value="<?php if($alunoUsuario[0]['ativo'] == 1){ echo "Ativo"; }elseif($alunoUsuario[0]['ativo'] == 0){ echo "Inativo";}?>">
						<?php
						//var_dump($getAtivo);
							if($getAtivo['ativo'] == 1){
								echo "Ativo";
							}elseif($getAtivo['ativo'] == 0){
								echo "Bloqueado";
							}
						?>					
					</p>
						
				</div>
				<div class="col-md-2 ">
					<strong>Patrocinador: </strong><br>
					<p>- - - - -</p>
				</div>
				<div class="col-md-2">
					<strong>Investidos: </strong><br>
					<p>- - - - -</p>
				</div>
				<div class="col-md-2">
					<strong>Forma de pagamento: </strong><br>
					<p>- - - - -</p>
				</div>
			</div>
		</div>	
		


	</div>
			
	